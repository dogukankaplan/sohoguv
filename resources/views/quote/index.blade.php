@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen" style="padding-top: 120px; padding-bottom: 24px;">
        <div class="max-w-4xl mx-auto px-4">
            {{-- Action Buttons --}}
            <div
                style="margin-bottom: 16px; display: flex; justify-content: flex-end; gap: 12px; position: relative; z-index: 10;">
                <button onclick="window.print()"
                    style="padding: 8px 24px; background-color: #6B7280; color: white; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; font-weight: 500;">
                    Yazdır
                </button>
                <button onclick="generatePDF()"
                    style="padding: 8px 24px; background-color: #0A1628; color: white; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; font-weight: 500;">
                    PDF Oluştur
                </button>
            </div>

            {{-- Quote Document --}}
            <div class="bg-white shadow-sm" id="quote-content" style="padding: 40px; font-family: Arial, sans-serif;">
                {{-- Header --}}
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px;">
                    {{-- Left: Logo & Company Info --}}
                    <div style="flex: 1;">
                        @if(isset($siteIdentity->logo) && $siteIdentity->logo)
                            <img src="{{ Storage::url($siteIdentity->logo) }}" alt="Logo"
                                style="height: 40px; width: auto; margin-bottom: 15px;">
                        @else
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                                <div
                                    style="width: 35px; height: 35px; background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%); border-radius: 8px;">
                                </div>
                                <span style="font-size: 22px; font-weight: 900; color: #0A1628;">soho</span>
                            </div>
                        @endif

                        <div style="font-size: 9px; line-height: 1.4; color: #000;">
                            <p style="margin: 0 0 2px 0; font-weight: 600; font-size: 10px;">SOHO GÜVENLİK BİLGİSAYAR VE
                                ELEKTRONİK PAZARLAMA LTD.ŞTİ.</p>
                            <p style="margin: 0 0 2px 0;">İpek iş merkezi Bornova İZMİR</p>
                            <p style="margin: 0 0 2px 0;">Güvenlik Bilgisayar Ve Ele.Sis.Paz.Tic.Ltd.Şti.</p>
                            <p style="margin: 0 0 2px 0;">IBAN: TR43 0015 7000 0000 0160 4230 85</p>
                            <p style="margin: 0 0 2px 0;">Banka adı: Enpara Bank A.Ş.</p>
                            <p style="margin: 0 0 2px 0;">Operasyon Merkezi: 7014 sokak no: 25/A</p>
                            <p style="margin: 6px 0 2px 0;">İzmir / Bornova</p>
                            <p style="margin: 0 0 2px 0;">05306878335</p>
                            <p style="margin: 0 0 2px 0;">05541820731</p>
                            <p style="margin: 6px 0 2px 0;">V.D: Karşıyaka</p>
                            <p style="margin: 0;">7721726850</p>
                        </div>
                    </div>

                    {{-- Right: Title --}}
                    <div style="text-align: right;">
                        <h1 style="font-size: 48px; font-weight: 900; color: #000; margin: 0; letter-spacing: 3px;">TEKLİF
                        </h1>
                    </div>
                </div>

                {{-- Date --}}
                <div
                    style="margin-bottom: 15px; padding: 8px 0; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;">
                    <div style="font-size: 10px;">
                        <span style="font-weight: 600;">TARIH:</span>
                        <input type="date" value="{{ date('Y-m-d') }}"
                            style="border: none; font-size: 10px; margin-left: 5px; outline: none;"
                            onchange="updateDate(this.value)">
                    </div>
                </div>

                {{-- Customer Section --}}
                <div style="margin-bottom: 25px; border-top: 1px solid #000; padding-top: 10px;">
                    <div
                        style="font-size: 11px; font-weight: 700; margin-bottom: 10px; border-bottom: 1px solid #000; width: fit-content; padding-bottom: 2px;">
                        MÜŞTERİ</div>
                    <div style="margin-bottom: 8px;">
                        <input type="text" id="customer-name" placeholder="HIKVISION 4LU AHD SET"
                            style="width: 100%; border: none; padding: 2px 0; font-size: 11px; font-weight: 700; background: transparent; color: #000; outline: none;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <input type="text" id="customer-location" placeholder="aydın/kuşadası"
                            style="width: 100%; border: none; padding: 2px 0; font-size: 10px; background: transparent; color: #000; outline: none;">
                    </div>
                    <div style="border-bottom: 1px solid #ddd; width: 100%;"></div>
                </div>

                {{-- Products Table --}}
                <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-bottom: 15px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #000;">
                            <th style="text-align: left; padding: 6px 4px; font-weight: 600;">Hizmet / Ürün</th>
                            <th style="text-align: center; padding: 6px 4px; font-weight: 600; width: 60px;">Miktar</th>
                            <th style="text-align: right; padding: 6px 4px; font-weight: 600; width: 80px;">Br. Fiyat</th>
                            <th style="text-align: right; padding: 6px 4px; font-weight: 600; width: 50px;">KDV</th>
                            <th style="text-align: right; padding: 6px 4px; font-weight: 600; width: 90px;">Toplam</th>
                        </tr>
                    </thead>
                    <tbody id="product-rows">
                        <tr class="product-row" style="border-bottom: 1px solid #e5e5e5;">
                            <td style="padding: 4px;">
                                <input type="text" class="product-name" placeholder="Hikvision 2mp bullet camera"
                                    style="width: 100%; border: none; font-size: 9px; padding: 2px;">
                            </td>
                            <td style="padding: 4px; text-align: center;">
                                <input type="number" class="quantity" value="4" min="1"
                                    style="width: 35px; border: none; text-align: center; font-size: 9px; padding: 2px;">
                                <span style="font-size: 9px; margin-left: 2px;">Adet</span>
                            </td>
                            <td style="padding: 4px; text-align: right;">
                                <input type="number" class="unit-price" value="25" step="0.01"
                                    style="width: 50px; border: none; text-align: right; font-size: 9px; padding: 2px;">
                                <span style="font-size: 9px; margin-left: 2px;">$</span>
                            </td>
                            <td style="padding: 4px; text-align: right;">
                                <span style="font-size: 9px;">%20</span>
                            </td>
                            <td style="padding: 4px; text-align: right; font-weight: 600;">
                                <span class="row-total">100,00 $</span>
                            </td>
                        </tr>
                    </tbody>
                </table>



                {{-- Bottom Section: Notes & Totals --}}
                <div
                    style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 30px; border-top: 1px solid #000; padding-top: 15px;">
                    {{-- Left: Notes --}}
                    <div id="notes-container" style="flex: 1; padding-right: 40px;">
                        <div style="font-size: 10px; font-weight: 700; color: #000; margin-bottom: 4px;">NOTLAR:</div>
                        <div contenteditable="true" id="quote-note"
                            style="font-size: 10px; color: #333; outline: none; border: none; min-width: 200px; padding: 2px 0; border-bottom: 1px dashed transparent;"
                            onfocus="if(this.innerText==='Yukarıda vermiş olduğumuz teklifimiz KDV HARİÇ olarak hesaplanmıştır...') this.innerText=''; this.style.borderBottom='1px dashed #ccc'"
                            onblur="if(this.innerText==='') this.innerText='Yukarıda vermiş olduğumuz teklifimiz KDV HARİÇ olarak hesaplanmıştır...'; this.style.borderBottom='1px dashed transparent'">
                            Yukarıda vermiş olduğumuz teklifimiz KDV HARİÇ olarak hesaplanmıştır. Şirket politikası gereği
                            50.000 TL üstü projelerde , Projenin tamamının %50’si peşin olarak proje başlangıcında
                            alınmaktadır. Kalan ödeme tutarı proje teslim zamanı tahsil edilmektedir. Projelerimize
                            yol,yemek ve konaklama ücretleri DAHİLDİR.</div>
                    </div>

                    {{-- Right: Totals --}}
                    <div style="width: 240px;">
                        <div style="display: flex; justify-content: space-between; padding: 4px 0; font-size: 10px;">
                            <span style="font-weight: 600;">ARA TOPLAM</span>
                            <span id="subtotal" style="font-weight: 600;">0,00 $</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 4px 0; font-size: 10px;">
                            <span style="font-weight: 600;">BRÜT TOPLAM</span>
                            <span id="gross-total" style="font-weight: 600;">0,00 $</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 4px 0; font-size: 10px;">
                            <span style="font-weight: 600;">TOPLAM K.D.V</span>
                            <span id="total-vat" style="font-weight: 600;">0,00 $</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; padding: 6px 0; border-top: 2px solid #000; font-size: 11px; margin-top: 4px;">
                            <span style="font-weight: 700;">GENEL TOPLAM</span>
                            <span id="grand-total" style="font-weight: 700;">0,00 $</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Add Row --}}
            <div style="margin-top: 15px; margin-bottom: 25px;" class="no-print">
                <button onclick="addRow()"
                    style="font-size: 10px; color: #3B82F6; background: none; border: none; cursor: pointer; font-weight: 600;">+
                    Satır Ekle</button>
            </div>
        </div>

        {{-- Scripts --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

        <style>
            @media print {
                .no-print {
                    display: none !important;
                }

                body {
                    margin: 0;
                    padding: 0;
                }

                #quote-content {
                    box-shadow: none !important;
                    margin: 0 !important;
                    padding: 20mm !important;
                }
            }
        </style>

        <script>
            function formatNumber(num) {
                return num.toFixed(2).replace('.', ',');
            }

            function calculateTotals() {
                let subtotal = 0;

                document.querySelectorAll('.product-row').forEach(row => {
                    const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                    const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
                    const rowTotal = quantity * unitPrice;

                    row.querySelector('.row-total').textContent = formatNumber(rowTotal) + ' $';
                    subtotal += rowTotal;
                });

                const vat = subtotal * 0.20;
                const grandTotal = subtotal + vat;

                document.getElementById('subtotal').textContent = formatNumber(subtotal) + ' $';
                document.getElementById('gross-total').textContent = formatNumber(subtotal) + ' $';
                document.getElementById('total-vat').textContent = formatNumber(vat) + ' $';
                document.getElementById('grand-total').textContent = formatNumber(grandTotal) + ' $';
            }

            function addRow() {
                const tbody = document.getElementById('product-rows');
                const newRow = document.createElement('tr');
                newRow.className = 'product-row';
                newRow.style.borderBottom = '1px solid #e5e5e5';
                newRow.innerHTML = `
                                                <td style="padding: 4px;">
                                                    <input type="text" class="product-name" placeholder="Ürün adı" style="width: 100%; border: none; font-size: 9px; padding: 2px;">
                                                </td>
                                                <td style="padding: 4px; text-align: center;">
                                                    <input type="number" class="quantity" value="1" min="1" style="width: 35px; border: none; text-align: center; font-size: 9px; padding: 2px;">
                                                    <span style="font-size: 9px; margin-left: 2px;">Adet</span>
                                                </td>
                                                <td style="padding: 4px; text-align: right;">
                                                    <input type="number" class="unit-price" value="0" step="0.01" style="width: 50px; border: none; text-align: right; font-size: 9px; padding: 2px;">
                                                    <span style="font-size: 9px; margin-left: 2px;">$</span>
                                                </td>
                                                <td style="padding: 4px; text-align: right;">
                                                    <span style="font-size: 9px;">%20</span>
                                                </td>
                                                <td style="padding: 4px; text-align: right; font-weight: 600;">
                                                    <span class="row-total">0,00 $</span>
                                                </td>
                                            `;

                tbody.appendChild(newRow);

                // Add event listeners
                newRow.querySelector('.quantity').addEventListener('input', calculateTotals);
                newRow.querySelector('.unit-price').addEventListener('input', calculateTotals);
            }

            function generatePDF() {
                const element = document.getElementById('quote-content');
                const notesContainer = document.getElementById('notes-container');
                const noteContent = document.getElementById('quote-note');

                // Hide notes if it's the placeholder or empty
                let notesHidden = false;
                if (noteContent && (noteContent.innerText.trim() === '' || noteContent.innerText.trim() === 'İsteğe bağlı not ekleyebilirsiniz...')) {
                    notesContainer.style.visibility = 'hidden';
                    notesHidden = true;
                }

                const opt = {
                    margin: 10,
                    filename: 'teklif-' + new Date().toISOString().slice(0, 10) + '.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2, useCORS: true, logging: false },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().set(opt).from(element).save().then(() => {
                    if (notesHidden) {
                        notesContainer.style.visibility = 'visible';
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