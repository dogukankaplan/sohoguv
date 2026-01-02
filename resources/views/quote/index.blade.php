@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen py-32 print:py-0 print:bg-white">
        <div class="container-custom max-w-5xl">
            {{-- Action Buttons --}}
            <div class="flex justify-end gap-4 mb-8 print:hidden">
                <button onclick="window.print()" class="btn-white text-sm py-2 px-6">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Yazdır
                </button>
                <button onclick="generatePDF()" class="btn-gradient-primary text-sm py-2 px-6">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    PDF Oluştur
                </button>
            </div>

            {{-- Quote Document --}}
            <div id="quote-content" class="bg-white rounded-3xl shadow-soft p-12 print:shadow-none print:p-0">
                {{-- Header --}}
                <div class="flex justify-between items-start mb-12 border-b border-gray-100 pb-12">
                    {{-- Left: Logo & Company Info --}}
                    <div class="space-y-6">
                        @if(isset($siteIdentity->logo) && $siteIdentity->logo)
                            <img src="{{ Storage::url($siteIdentity->logo) }}" alt="Logo" class="h-16 w-auto">
                        @else
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-magenta-500"></div>
                                <span class="text-3xl font-bold tracking-tight text-gray-900">SOHO<span
                                        class="text-gradient">Güvenlik</span></span>
                            </div>
                        @endif

                        <div class="text-xs text-gray-500 space-y-1">
                            <p class="font-bold text-gray-900 uppercase">SOHO Güvenlik Bilgisayar ve Ele. Sis. Paz. Tic.
                                Ltd. Şti.</p>
                            <p>İpek İş Merkezi, Bornova, İZMİR</p>
                            <p>Operasyon Merkezi: 7014 Sokak No: 25/A</p>
                            <p class="pt-2"><span class="font-semibold text-gray-700">Tel:</span> 0530 687 83 35 / 0554 182
                                07 31</p>
                            <p class="font-semibold text-gray-900 pt-2">Banka Bilgileri:</p>
                            <p>Enpara Bank A.Ş. - TR43 0015 7000 0000 0160 4230 85</p>
                            <p>V.D: Karşıyaka - V.No: 7721726850</p>
                        </div>
                    </div>

                    {{-- Right: Title & Settings --}}
                <div class="text-right">
                    <h1 class="text-6xl font-bold text-gray-900 tracking-tight opacity-10 uppercase">Teklif</h1>
                    <div class="mt-4 flex flex-col items-end gap-2">
                        <div class="inline-flex items-center bg-gray-50 rounded-lg p-2 border border-gray-200">
                            <span class="text-xs font-bold text-gray-500 mr-2 uppercase">Tarih:</span>
                            <input type="date" value="{{ date('Y-m-d') }}" class="bg-transparent border-none text-xs font-semibold text-gray-900 focus:ring-0 p-0" onchange="updateDate(this.value)">
                        </div>
                        {{-- Currency Toggle --}}
                        <div class="inline-flex items-center bg-gray-50 rounded-lg p-1 border border-gray-200 print:hidden">
                            <button onclick="setCurrency('USD')" id="btn-usd" class="px-3 py-1 rounded-md text-xs font-bold transition-all bg-white shadow-sm text-cyan-600">USD ($)</button>
                            <button onclick="setCurrency('TRY')" id="btn-try" class="px-3 py-1 rounded-md text-xs font-bold text-gray-500 hover:text-gray-700 transition-all">TL (₺)</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Customer Section --}}
            <div class="mb-12 bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <div class="text-xs font-bold text-cyan-600 uppercase tracking-wider mb-2">Sayın Müşteri</div>
                <input type="text" id="customer-name" placeholder="Müşteri / Firma Adı Giriniz" class="w-full bg-transparent border-none text-xl font-bold text-gray-900 placeholder-gray-300 focus:ring-0 p-0 mb-1">
                <input type="text" id="customer-location" placeholder="Lokasyon / Adres" class="w-full bg-transparent border-none text-sm text-gray-500 placeholder-gray-300 focus:ring-0 p-0">
            </div>

            {{-- Products Table --}}
            <div class="mb-12">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="text-left py-4 text-xs font-bold text-gray-500 uppercase tracking-wider pl-4">Hizmet / Ürün Açıklaması</th>
                            <th class="text-center py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-24">Miktar</th>
                            <th class="text-right py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-32">Birim Fiyat</th>
                            <th class="text-right py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-20">KDV</th>
                            <th class="text-right py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-32 pr-4">Toplam</th>
                            <th class="w-10 print:hidden"></th>
                        </tr>
                    </thead>
                    <tbody id="product-rows" class="divide-y divide-gray-50">
                        <tr class="product-row group hover:bg-gray-50 transition">
                            <td class="p-2">
                                <input type="text" class="product-name w-full bg-transparent border-none text-sm text-gray-700 focus:ring-0 pl-2 rounded-lg" placeholder="Ürün veya hizmet adını giriniz">
                            </td>
                            <td class="p-2">
                                <div class="flex items-center justify-center bg-white rounded-lg border border-gray-200 h-8 w-20 mx-auto">
                                    <input type="number" class="quantity w-10 text-center border-none text-xs p-0 focus:ring-0" value="1" min="1">
                                    <span class="text-[10px] text-gray-400 select-none mr-1">Ad.</span>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="flex items-center justify-end">
                                    <input type="number" class="unit-price w-20 text-right border-none text-sm focus:ring-0 p-0" value="0" step="0.01">
                                    <span class="currency-symbol text-xs text-gray-400 ml-1 select-none">$</span>
                                </div>
                            </td>
                            <td class="p-2 text-right">
                                <span class="text-xs text-gray-400 select-none">%20</span>
                            </td>
                            <td class="p-2 text-right pr-4 font-semibold text-gray-900">
                                <span class="row-total">0,00 $</span>
                            </td>
                            <td class="p-2 text-center print:hidden">
                                <button onclick="deleteRow(this)" class="text-gray-300 hover:text-red-500 transition p-1 rounded-full hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Bottom Section --}}
            <div class="flex flex-col md:flex-row justify-between items-end gap-12 pt-8 border-t border-gray-100">
                {{-- Notes --}}
                <div id="notes-container" class="flex-1 w-full md:w-auto">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Notlar & Şartlar</div>
                    <div contenteditable="true" id="quote-note" class="text-xs text-gray-500 leading-relaxed outline-none border-b border-transparent focus:border-cyan-300 transition py-2 empty:before:content-[attr(placeholder)] empty:before:text-gray-300" placeholder="Not eklemek için buraya tıklayın...">
                        Yukarıda vermiş olduğumuz teklifimiz KDV HARİÇ olarak hesaplanmıştır. Şirket politikası gereği 50.000 TL üstü projelerde, projenin tamamının %50’si peşin olarak proje başlangıcında alınmaktadır. Kalan ödeme tutarı proje teslim zamanı tahsil edilmektedir. Projelerimize yol, yemek ve konaklama ücretleri DAHİLDİR.
                    </div>
                </div>

                {{-- Totals --}}
                <div class="w-full md:w-80 bg-gray-50 rounded-2xl p-6">
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Ara Toplam</span>
                            <span id="subtotal" class="font-semibold text-gray-900">0,00 $</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">KDV (%20)</span>
                            <span id="total-vat" class="font-semibold text-gray-900">0,00 $</span>
                        </div>
                        <div class="pt-4 mt-2 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Genel Toplam</span>
                                <span id="grand-total" class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-magenta-600">0,00 $</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Row Button --}}
        <div class="mt-8 text-center print:hidden">
            <button onclick="addRow()" class="inline-flex items-center gap-2 text-sm font-semibold text-cyan-600 hover:text-cyan-700 transition px-4 py-2 rounded-full hover:bg-cyan-50">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Yeni Satır Ekle
            </button>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
    /* Force hide elements during JS PDF generation */
    .pdf-mode .print\:hidden {
        display: none !important;
    }

    @media print {
        @page { margin: 0; }
        body { margin: 0; padding: 0; -webkit-print-color-adjust: exact; background: white !important; }
        .print\:hidden { display: none !important; }
        .print\:shadow-none { box-shadow: none !important; }
        .print\:py-0 { padding-top: 0 !important; padding-bottom: 0 !important; }
        .print\:bg-white { background-color: white !important; }
        
        /* Gradient Text Fix for Print/PDF */
        .text-gradient, 
        .bg-clip-text,
        #grand-total { 
            background: none !important;
            -webkit-text-fill-color: #0891B2 !important; /* solid cyan-600 */
            color: #0891B2 !important;
        }
    }
</style>

<script>
    let currency = 'USD';
    let currencySymbol = '$';

    function setCurrency(curr) {
        currency = curr;
        if (curr === 'USD') {
            currencySymbol = '$';
            document.getElementById('btn-usd').className = 'px-3 py-1 rounded-md text-xs font-bold transition-all bg-white shadow-sm text-cyan-600';
            document.getElementById('btn-try').className = 'px-3 py-1 rounded-md text-xs font-bold text-gray-500 hover:text-gray-700 transition-all';
        } else {
            currencySymbol = '₺';
            document.getElementById('btn-try').className = 'px-3 py-1 rounded-md text-xs font-bold transition-all bg-white shadow-sm text-cyan-600';
            document.getElementById('btn-usd').className = 'px-3 py-1 rounded-md text-xs font-bold text-gray-500 hover:text-gray-700 transition-all';
        }
        
        // Update all symbol spans
        document.querySelectorAll('.currency-symbol').forEach(el => el.textContent = currencySymbol);
        calculateTotals();
    }

    function formatNumber(num) {
        return num.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function calculateTotals() {
        let subtotal = 0;

        document.querySelectorAll('.product-row').forEach(row => {
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
            const rowTotal = quantity * unitPrice;

            row.querySelector('.row-total').textContent = formatNumber(rowTotal) + ' ' + currencySymbol;
            subtotal += rowTotal;
        });

        const vat = subtotal * 0.20;
        const grandTotal = subtotal + vat;

        document.getElementById('subtotal').textContent = formatNumber(subtotal) + ' ' + currencySymbol;
        document.getElementById('total-vat').textContent = formatNumber(vat) + ' ' + currencySymbol;
        document.getElementById('grand-total').textContent = formatNumber(grandTotal) + ' ' + currencySymbol;
    }

    function deleteRow(btn) {
        const row = btn.closest('tr');
        // Don't delete if it's the last row, or clear it instead
        if (document.querySelectorAll('.product-row').length > 1) {
            row.remove();
        } else {
            row.querySelector('.product-name').value = '';
            row.querySelector('.quantity').value = 1;
            row.querySelector('.unit-price').value = 0;
        }
        calculateTotals();
    }

    function addRow() {
        const tbody = document.getElementById('product-rows');
        const newRow = document.createElement('tr');
        newRow.className = 'product-row group hover:bg-gray-50 transition border-t border-gray-50';
        newRow.innerHTML = `
            <td class="p-2">
                <input type="text" class="product-name w-full bg-transparent border-none text-sm text-gray-700 focus:ring-0 pl-2 rounded-lg" placeholder="Ürün adı">
            </td>
            <td class="p-2">
                <div class="flex items-center justify-center bg-white rounded-lg border border-gray-200 h-8 w-20 mx-auto">
                    <input type="number" class="quantity w-10 text-center border-none text-xs p-0 focus:ring-0" value="1" min="1">
                    <span class="text-[10px] text-gray-400 select-none mr-1">Ad.</span>
                </div>
            </td>
            <td class="p-2">
                <div class="flex items-center justify-end">
                    <input type="number" class="unit-price w-20 text-right border-none text-sm focus:ring-0 p-0" value="0" step="0.01">
                    <span class="currency-symbol text-xs text-gray-400 ml-1 select-none">` + currencySymbol + `</span>
                </div>
            </td>
            <td class="p-2 text-right">
                <span class="text-xs text-gray-400 select-none">%20</span>
            </td>
            <td class="p-2 text-right pr-4 font-semibold text-gray-900">
                <span class="row-total">0,00 ` + currencySymbol + `</span>
            </td>
            <td class="p-2 text-center print:hidden">
                <button onclick="deleteRow(this)" class="text-gray-300 hover:text-red-500 transition p-1 rounded-full hover:bg-red-50">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </td>
        `;

        tbody.appendChild(newRow);

        // Add event listeners
        newRow.querySelector('.quantity').addEventListener('input', calculateTotals);
        newRow.querySelector('.unit-price').addEventListener('input', calculateTotals);
    }

    function generatePDF() {
        const element = document.getElementById('quote-content');
        
        // Add temporary class to handle gradient text fix specifically for html2pdf
        element.classList.add('pdf-mode');
        
        // Add inline style to grand-total to force solid color during capture
        const grandTotal = document.getElementById('grand-total');
        const originalStyle = grandTotal.getAttribute('style');
        grandTotal.style.background = 'none';
        grandTotal.style.webkitTextFillColor = '#0891B2';
        grandTotal.style.color = '#0891B2';

        const opt = {
            margin: 0,
            filename: 'soho-teklif-' + new Date().toISOString().slice(0, 10) + '.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, logging: false },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save().then(() => {
            // Revert changes
            element.classList.remove('pdf-mode');
            if (originalStyle) {
                grandTotal.setAttribute('style', originalStyle);
            } else {
                grandTotal.removeAttribute('style');
            }
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
        calculateTotals();

        // Add event listeners to initial row
        document.querySelectorAll('.quantity, .unit-price').forEach(input => {
            input.addEventListener('input', calculateTotals);
        });
    });
</script>
@endsection