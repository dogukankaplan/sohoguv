@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white">
        {{-- Hero Section --}}
        <section class="relative pt-32 pb-16 bg-gradient-to-br from-slate-50 to-white border-b border-slate-100">
            <div class="container-custom">
                <div class="max-w-4xl mx-auto text-center">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent-50 border border-accent-100 text-accent-700 text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Kullanım Koşulları</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                        Kullanım Koşulları
                    </h1>
                    <p class="text-lg text-slate-600">
                        Son Güncelleme: {{ date('d.m.Y') }}
                    </p>
                </div>
            </div>
        </section>

        {{-- Content --}}
        <section class="py-16 lg:py-20">
            <div class="container-custom">
                <div class="max-w-4xl mx-auto prose prose-slate prose-lg">

                    {{-- 1. Genel Koşullar --}}
                    <h2>1. Genel Koşullar</h2>
                    <p>
                        Bu web sitesini kullanarak, aşağıdaki kullanım koşullarını okuduğunuzu, anladığınızı ve kabul
                        ettiğinizi beyan edersiniz. Bu koşulları kabul etmiyorsanız, lütfen sitemizi kullanmayınız.
                    </p>
                    <p>
                        {{ setting('site_name', 'SOHO Güvenlik Sistemleri') }}, bu koşulları önceden haber vermeksizin
                        değiştirme hakkını saklı tutar. Değişiklikler bu sayfada yayınlandığında yürürlüğe girer.
                    </p>

                    {{-- 2. Hizmet Tanımı --}}
                    <h2>2. Hizmetlerimiz</h2>
                    <p>
                        {{ setting('site_name', 'SOHO Güvenlik Sistemleri') }} olarak aşağıdaki hizmetleri sunmaktayız:
                    </p>
                    <ul>
                        <li>Güvenlik kamera sistemleri kurulumu ve bakımı</li>
                        <li>Alarm sistemleri montajı ve teknik desteği</li>
                        <li>Yangın algılama ve ihbar sistemleri</li>
                        <li>Akıllı ev ve bina otomasyon sistemleri</li>
                        <li>Ağ altyapısı ve fiber optik çözümleri</li>
                        <li>7/24 teknik destek ve arıza servisi</li>
                    </ul>

                    {{-- 3. Kullanım Kuralları --}}
                    <h2>3. Web Sitesi Kullanım Kuralları</h2>
                    <p>Bu web sitesini kullanırken aşağıdaki kurallara uymanız gerekmektedir:</p>
                    <ul>
                        <li>Yasa dışı, zararlı veya yanıltıcı içerik paylaşmamak</li>
                        <li>Diğer kullanıcıların haklarına saygı göstermek</li>
                        <li>Sitenin güvenliğini tehlikeye atacak eylemlerde bulunmamak</li>
                        <li>Virüs, kötü amaçlı yazılım veya zararlı kod göndermemek</li>
                        <li>Otomatik sistemler (botlar, crawler'lar) kullanmamak</li>
                        <li>Telif haklarına ve fikri mülkiyet haklarına saygı göstermek</li>
                    </ul>

                    {{-- 4. Fikri Mülkiyet --}}
                    <h2>4. Fikri Mülkiyet Hakları</h2>
                    <p>
                        Bu web sitesindeki tüm içerik, tasarım, logo, metin, grafik, fotoğraf ve diğer materyaller
                        {{ setting('site_name', 'SOHO Güvenlik Sistemleri') }}'nin veya lisans verenlerin mülkiyetindedir ve
                        telif hakkı yasalarıyla korunmaktadır.
                    </p>
                    <p>
                        İçeriklerin izinsiz kopyalanması, dağıtılması, değiştirilmesi veya ticari amaçla kullanılması
                        yasaktır. Kişisel ve ticari olmayan kullanım için görüntüleme ve yazdırma iznine sahipsiniz.
                    </p>

                    {{-- 5. Hizmet Sözleşmeleri --}}
                    <h2>5. Hizmet Sözleşme Koşulları</h2>
                    <h3>5.1. Teklif ve Sipariş Süreci</h3>
                    <ul>
                        <li>Web sitesi üzerinden yapılan talepler teklif talebi niteliğindedir</li>
                        <li>Teklifler, keşif sonrası hazırlanır ve geçerlilik süresi belirtilir</li>
                        <li>Yazılı sipariş onayı sonrası sözleşme bağlayıcı hale gelir</li>
                        <li>Ekspertiz ücreti projeye dahil edilebilir veya ayrıca tahsil edilebilir</li>
                    </ul>

                    <h3>5.2. Fiyatlandırma ve Ödeme</h3>
                    <ul>
                        <li>Tüm fiyatlar KDV dahildir (aksi belirtilmedikçe)</li>
                        <li>Ödeme koşulları sözleşmede belirtilir</li>
                        <li>Avans ödemesi talep edilebilir</li>
                        <li>Gecikmiş ödemeler için yasal faiz uygulanabilir</li>
                    </ul>

                    <h3>5.3. Kurulum ve Teslimat</h3>
                    <ul>
                        <li>Kurulum tarihleri sözleşmede belirtilir</li>
                        <li>Force majeure durumlarında teslimat gecikebilir</li>
                        <li>Müşteri, kurulum için uygun ortamı sağlamakla yükümlüdür</li>
                        <li>Teslimat, tutanak ile tescillenir</li>
                    </ul>

                    {{-- 6. Garanti ve Sorumluluk --}}
                    <h2>6. Garanti ve Sorumluluk Koşulları</h2>
                    <h3>6.1. Ürün Garantisi</h3>
                    <ul>
                        <li>Malzemeler, üretici garantisi kapsamındadır</li>
                        <li>İşçilik garantisi sözleşmede belirtilir (genellikle 1-2 yıl)</li>
                        <li>Garanti, yanlış kullanım ve dış etkenlerden kaynaklanan hasarları kapsamaz</li>
                    </ul>

                    <h3>6.2. Sorumluluk Sınırları</h3>
                    <p>
                        {{ setting('site_name', 'SOHO Güvenlik Sistemleri') }}, aşağıdaki durumlardan sorumlu tutulamaz:
                    </p>
                    <ul>
                        <li>Sistemin yetkisiz kişiler tarafından manipüle edilmesi</li>
                        <li>Müşteri kaynaklı yanlış kullanım veya ihmal</li>
                        <li>Doğal afetler ve force majeure durumları</li>
                        <li>Elektrik kesintisi veya internet bağlantı sorunları</li>
                        <li>Üçüncü taraf ürün ve hizmetlerden kaynaklanan sorunlar</li>
                    </ul>

                    {{-- 7. Teknik Destek --}}
                    <h2>7. Teknik Destek ve Bakım</h2>
                    <h3>7.1. 7/24 Destek</h3>
                    <ul>
                        <li>Acil arıza durumlarında 24 saat destek sağlanır</li>
                        <li>Telefon, e-posta ve web formu ile iletişim kurulabilir</li>
                        <li>Uzaktan destek hizmeti sunulmaktadır</li>
                        <li>Yerinde servis gerektiğinde randevu verilir</li>
                    </ul>

                    <h3>7.2. Bakım Sözleşmeleri</h3>
                    <ul>
                        <li>Periyodik bakım paketleri sunulmaktadır</li>
                        <li>Öncelikli servis hizmeti sağlanır</li>
                        <li>Yıllık kontrol ve güncellemeler dahildir</li>
                    </ul>

                    {{-- 8. İptal ve İade --}}
                    <h2>8. İptal ve İade Koşulları</h2>
                    <h3>8.1. Sipariş İptali</h3>
                    <ul>
                        <li>Kurulum öncesi iptal: Keşif ücreti tahsil edilir</li>
                        <li>Malzeme siparişi sonrası iptal: Sipariş edilen malzeme bedeli tahsil edilir</li>
                        <li>Kurulum sonrası iptal: Tam bedel tahsil edilir</li>
                    </ul>

                    <h3>8.2. İade Koşulları</h3>
                    <ul>
                        <li>Arızalı ürünler üretici garantisi kapsamında değiştirilir</li>
                        <li>Kurulmuş sistemlerde iade kabul edilmez</li>
                        <li>Poşeti açılmamış ürünler 14 gün içinde iade edilebilir (%20 restocking ücreti)</li>
                    </ul>

                    {{-- 9. Gizlilik --}}
                    <h2>9. Gizlilik ve Veri Koruma</h2>
                    <p>
                        Kişisel verilerinizin işlenmesi <a href="{{ route('privacy') }}"
                            class="text-brand-600 hover:text-brand-700">Gizlilik Politikamızda</a> detaylı olarak
                        açıklanmıştır. KVKK kapsamında tüm haklarınız saklıdır.
                    </p>

                    {{-- 10. Uyuşmazlık Çözümü --}}
                    <h2>10. Uygulanacak Hukuk ve Yetki</h2>
                    <p>
                        Bu kullanım koşulları Türkiye Cumhuriyeti yasalarına tabidir. Bu koşullardan kaynaklanan
                        uyuşmazlıklarda İstanbul Mahkemeleri ve İcra Daireleri yetkilidir.
                    </p>

                    {{-- 11. İletişim --}}
                    <h2>11. İletişim ve Destek</h2>
                    <p>
                        Sorularınız, görüşleriniz veya şikayetleriniz için bizimle iletişime geçebilirsiniz:
                    </p>
                    <div class="bg-slate-50 rounded-2xl p-6 not-prose">
                        <p class="text-sm text-slate-600 mb-3">
                            <strong>{{ setting('site_name', 'SOHO Güvenlik Sistemleri') }}</strong></p>
                        <p class="text-sm text-slate-600 mb-2">
                            <strong>E-posta:</strong> {{ setting('email', 'info@sohoguvenlik.com') }}
                        </p>
                        <p class="text-sm text-slate-600 mb-2">
                            <strong>Telefon:</strong> {{ setting('phone', '+90 (555) 123 45 67') }}
                        </p>
                        <p class="text-sm text-slate-600 mb-2">
                            <strong>Destek Hattı:</strong> 7/24 Açık
                        </p>
                        <p class="text-sm text-slate-600">
                            <strong>Adres:</strong> {{ setting('address', 'Türkiye') }}
                        </p>
                    </div>

                    <div class="mt-12 p-6 bg-accent-50 border-l-4 border-accent-600 rounded-r-lg">
                        <p class="text-sm text-accent-900 font-semibold mb-2">
                            ✓ Bu kullanım koşulları {{ date('d.m.Y') }} tarihinde son güncellenmiştir.
                        </p>
                        <p class="text-sm text-accent-800">
                            Web sitemizi veya hizmetlerimizi kullanarak bu koşulları kabul etmiş sayılırsınız.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection