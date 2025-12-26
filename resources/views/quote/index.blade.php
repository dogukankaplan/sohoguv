@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen py-8">
        <div class="max-w-5xl mx-auto px-4">
            {{-- Toolbar for Print/Save --}}
            <div class="mb-4 flex justify-end gap-2 no-print">
                <button onclick="window.print()" class="btn-primary px-4 py-2 text-sm">
                    <svg class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Yazdır
                </button>
            </div>

            {{-- Quote Document --}}
            <div class="bg-white border border-neutral-200 shadow-sm p-8" id="quote-document">
                {{-- Header --}}
                <div class="flex justify-between items-start mb-8">
                    {{-- Company Info --}}
                    <div class="flex-1">
                        <div class="mb-4">
                            @if(isset($siteIdentity->logo) && $siteIdentity->logo)
                                <img src="{{ Storage::url($siteIdentity->logo) }}"
                                    alt="{{ $siteIdentity->site_name ?? 'SOHO' }}" class="h-12 w-auto">
                            @else
                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 bg-gradient-to-br from-secondary-500 to-accent-500 rounded-lg"></div>
                                    <span class="text-2xl font-black text-primary-500">soho</span>
                                </div>
                            @endif
                        </div>
                        <div class="text-xs space-y-0.5 text-neutral-600">
                            <p class="font-semibold text-sm">
                                {{ $siteIdentity->site_name ?? 'SOHO GÜVENLİK BİLGİSAYAR VE ELEKTRONİK PAZARLAMA LTD.ŞTİ.' }}
                            </p>
                            <p>{{ setting('company_address', 'İpek iş merkezi Bornova İZMİR') }}</p>
                            <p>Operasyon Merkezi: {{ setting('operation_address', '7014 sokak no: 25/A') }}</p>
                            <p class="mt-2">{{ setting('city', 'İzmir') }} / {{ setting('district', 'Bornova') }}</p>
                            <p>{{ setting('phone', '05306878335') }}</p>
                            <p>{{ setting('phone2', '05541820731') }}</p>
                            <p class="mt-2">V.D: {{ setting('tax_office', 'Karşıyaka') }}</p>
                            <p>{{ setting('tax_number', '7721726850') }}</p>
                        </div>
                    </div>

                    {{-- Quote Title --}}
                    <div class="text-right">
                        <h1 class="text-4xl font-black text-primary-500 tracking-wider">TEKLİF</h1>
                    </div>
                </div>

                {{-- Customer Info --}}
                <div class="mb-6 border-t border-b border-neutral-200 py-3">
                    <div class="text-sm">
                        <div class="mb-2">
                            <span class="font-semibold">TARIH:</span>
                            <span contenteditable="true" class="editable px-1">{{ date('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mb-6 bg-neutral-50 p-3 border border-neutral-200">
                    <div class="font-semibold text-sm mb-2">MÜŞTERİ</div>
                    <div class="text-sm mb-1">
                        <input type="text" placeholder="Müşteri Adı"
                            class="w-full px-2 py-1 border border-neutral-300 rounded text-sm font-semibold">
                    </div>
                    <div class="text-xs text-neutral-600">
                        <input type="text" placeholder="Şehir/İlçe"
                            class="w-full px-2 py-1 border border-neutral-300 rounded text-xs">
                    </div>
                </div>

                {{-- Products Table --}}
                <table class="w-full text-xs mb-6">
                    <thead>
                        <tr class="border-b-2 border-neutral-300">
                            <th class="text-left py-2 font-semibold">Hizmet / Ürün</th>
                            <th class="text-center py-2 font-semibold w-20">Miktar</th>
                            <th class="text-right py-2 font-semibold w-24">Br. Fiyat</th>
                            <th class="text-right py-2 font-semibold w-16">KDV</th>
                            <th class="text-right py-2 font-semibold w-28">Toplam</th>
                        </tr>
                    </thead>
                    <tbody id="quote-items">
                        {{-- Initial Row --}}
                        <tr class="border-b border-neutral-100 quote-row">
                            <td class="py-1.5">
                                <input type="text" placeholder="Ürün/Hizmet adı"
                                    class="w-full px-1 border-0 focus:border-b focus:border-secondary-500 text-xs outline-none">
                            </td>
                            <td class="py-1.5 text-center">
                                <input type="number" value="1"
                                    class="quantity w-16 px-1 text-center border-0 focus:border-b focus:border-secondary-500 text-xs outline-none">
                                <span class="text-xs text-neutral-500 ml-1">Adet</span>
                            </td>
                            <td class="py-1.5 text-right">
                                <input type="number" value="0" step="0.01"
                                    class="unit-price w-20 px-1 text-right border-0 focus:border-b focus:border-secondary-500 text-xs outline-none">
                                <span class="text-xs text-neutral-500 ml-1">$</span>
                            </td>
                            <td class="py-1.5 text-right">
                                <input type="number" value="20"
                                    class="vat-rate w-12 px-1 text-right border-0 focus:border-b focus:border-secondary-500 text-xs outline-none">
                                <span class="text-xs text-neutral-500 ml-1">%</span>
                            </td>
                            <td class="py-1.5 text-right font-semibold row-total">0,00 $</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Add Row Button --}}
                <div class="mb-6 no-print">
                    <button onclick="addQuoteRow()"
                        class="text-xs text-secondary-500 hover:text-secondary-600 font-semibold">
                        + Satır Ekle
                    </button>
                </div>

                {{-- Totals --}}
                <div class="flex justify-end">
                    <div class="w-80 space-y-1.5 text-xs">
                        <div class="flex justify-between py-1.5 border-t border-neutral-200">
                            <span class="font-semibold">ARA TOPLAM</span>
                            <span id="subtotal" class="font-semibold">0,00 $</span>
                        </div>
                        <div class="flex justify-between py-1.5">
                            <span class="font-semibold">BRÜT TOPLAM</span>
                            <span id="gross-total" class="font-semibold">0,00 $</span>
                        </div>
                        <div class="flex justify-between py-1.5">
                            <span class="font-semibold">TOPLAM K.D.V</span>
                            <span id="total-vat" class="font-semibold">0,00 $</span>
                        </div>
                        <div class="flex justify-between py-2 border-t-2 border-neutral-300 text-sm">
                            <span class="font-bold">GENEL TOPLAM</span>
                            <span id="grand-total" class="font-bold">0,00 $</span>
                        </div>
                    </div>
                </div>

                {{-- Footer Notes --}}
                <div class="mt-8 pt-6 border-t border-neutral-200 text-xs text-neutral-600">
                    <p class="mb-2"><strong>Not:</strong> Bu teklif 15 gün geçerlidir.</p>
                    <p>Fiyatlarımıza KDV dahil değildir.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            #quote-document {
                box-shadow: none !important;
                border: none !important;
            }
        }

        .editable:focus {
            outline: 1px dashed #cbd5e0;
            background-color: #fefce8;
        }
    </style>

    <script>
        function addQuoteRow() {
            const tbody = document.getElementById('quote-items');
            const newRow = tbody.querySelector('.quote-row').cloneNode(true);

            // Clear input values
            newRow.querySelectorAll('input').forEach(input => {
                if (input.classList.contains('quantity')) {
                    input.value = '1';
                } else if (input.classList.contains('vat-rate')) {
                    input.value = '20';
                } else if (input.classList.contains('unit-price')) {
                    input.value = '0';
                } else {
                    input.value = '';
                }
            });
            newRow.querySelector('.row-total').textContent = '0,00 $';

            tbody.appendChild(newRow);
            attachCalculationListeners(newRow);
        }

        function formatCurrency(value) {
            return new Intl.NumberFormat('tr-TR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(value) + ' $';
        }

        function calculateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
            const total = quantity * unitPrice;
            row.querySelector('.row-total').textContent = formatCurrency(total);
            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let subtotal = 0;
            let totalVat = 0;

            document.querySelectorAll('.quote-row').forEach(row => {
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
                const vatRate = parseFloat(row.querySelector('.vat-rate').value) || 0;

                const rowTotal = quantity * unitPrice;
                const rowVat = rowTotal * (vatRate / 100);

                subtotal += rowTotal;
                totalVat += rowVat;
            });

            const grossTotal = subtotal;
            const grandTotal = grossTotal + totalVat;

            document.getElementById('subtotal').textContent = formatCurrency(subtotal);
            document.getElementById('gross-total').textContent = formatCurrency(grossTotal);
            document.getElementById('total-vat').textContent = formatCurrency(totalVat);
            document.getElementById('grand-total').textContent = formatCurrency(grandTotal);
        }

        function attachCalculationListeners(row) {
            row.querySelectorAll('input.quantity, input.unit-price, input.vat-rate').forEach(input => {
                input.addEventListener('input', () => calculateRowTotal(row));
            });
        }

        // Initialize calculation listeners on existing rows
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.quote-row').forEach(row => {
                attachCalculationListeners(row);
            });
        });
    </script>
@endsection