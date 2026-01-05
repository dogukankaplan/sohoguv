@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white">
        {{-- Hero Section --}}
        <section class="relative pt-32 pb-16 bg-gradient-to-br from-slate-50 to-white border-b border-slate-100">
            <div class="container-custom">
                <div class="max-w-4xl mx-auto text-center">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Gizlilik Politikası</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                        Gizlilik Politikası
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

                    {{-- 1. Giriş --}}
                    <h2>1. Giriş</h2>
                    <p>
                        {{ setting('site_name', 'SOHO Güvenlik Sistemleri') }} olarak, kişisel verilerinizin gizliliğini
                        korumak en önemli önceliğimizdir. Bu gizlilik politikası, web sitemizi ziyaret ettiğinizde veya
                        hizmetlerimizi kullandığınızda kişisel bilgilerinizin nasıl toplandığını, kullanıldığını ve
                        korunduğunu açıklar.
                    </p>

                    {{-- 2. Toplanan Bilgiler --}}
                    <h2>2. Toplanan Bilgiler</h2>
                    <p>Web sitemiz aracılığıyla aşağıdaki bilgileri toplayabiliriz:</p>
                    <ul>
                        <li><strong>İletişim Bilgileri:</strong> Ad, soyad, e-posta adresi, telefon numarası</li>
                        <li><strong>Firma Bilgileri:</strong> Şirket adı, adres, vergi numarası (ticari müşteriler için)
                        </li>
                        <li><strong>Teknik Bilgiler:</strong> IP adresi, tarayıcı türü, işletim sistemi, ziyaret edilen
                            sayfalar</li>
                        <li><strong>İletişim İçeriği:</strong> Bize gönderdiğiniz mesajlar ve talepler</li>
                    </ul>

                    {{-- 3. Bilgilerin Kullanımı --}}
                    <h2>3. Bilgilerin Kullanım Amaçları</h2>
                    <p>Topladığımız bilgileri aşağıdaki amaçlarla kullanırız:</p>
                    <ul>
                        <li>Hizmet taleplerinizi yanıtlamak ve teknik destek sağlamak</li>
                        <li>Teklif hazırlamak ve sözleşme süreçlerini yönetmek</li>
                        <li>Ürün ve hizmetlerimiz hakkında bilgilendirme yapmak</li>
                        <li>Web sitemizi geliştirmek ve kullanıcı deneyimini iyileştirmek</li>
                        <li>Yasal yükümlülüklerimizi yerine getirmek</li>
                        <li>Dolandırıcılığı önlemek ve güvenlik tedbirleri almak</li>
                    </ul>

                    {{-- 4. Çerezler --}}
                    <h2>4. Çerezler (Cookies)</h2>
                    <p>
                        Web sitemiz, kullanıcı deneyimini iyileştirmek için çerezler kullanmaktadır. Çerezler,
                        bilgisayarınızda saklanan küçük metin dosyalarıdır. Tarayıcı ayarlarınızdan çerezleri devre dışı
                        bırakabilirsiniz, ancak bu durumda bazı özellikler düzgün çalışmayabilir.
                    </p>

                    {{-- 5. Bilgi Paylaşımı --}}
                    <h2>5. Bilgi Paylaşımı ve Aktarımı</h2>
                    <p>Kişisel bilgilerinizi aşağıdaki durumlar haricinde üçüncü şahıslarla paylaşmayız:</p>
                    <ul>
                        <li><strong>Hizmet Sağlayıcılar:</strong> Kurulum, bakım ve teknik destek için anlaşmalı iş
                            ortaklarımız</li>
                        <li><strong>Yasal Zorunluluklar:</strong> Mahkeme kararı veya yasal talep olması durumunda</li>
                        <li><strong>İş Aktarımları:</strong> Şirket birleşmesi veya satışı durumunda</li>
                    </ul>
                    <p>
                        Tüm iş ortaklarımız, kişisel verilerinizi korumak için sözleşmesel yükümlülükler altındadır.
                    </p>

                    {{-- 6. Veri Güvenliği --}}
                    <h2>6. Veri Güvenliği</h2>
                    <p>
                        Kişisel verilerinizi korumak için endüstri standardı güvenlik önlemleri kullanıyoruz:
                    </p>
                    <ul>
                        <li>SSL şifrelemesi ile güvenli veri aktarımı</li>
                        <li>Güvenli sunucu altyapısı ve firewall koruması</li>
                        <li>Düzenli güvenlik güncellemeleri ve denetimler</li>
                        <li>Sınırlı erişim yetkisi ve personel eğitimleri</li>
                    </ul>

                    {{-- 7. Haklarınız --}}
                    <h2>7. Kullanıcı Hakları</h2>
                    <p>KVKK (Kişisel Verilerin Korunması Kanunu) kapsamında aşağıdaki haklara sahipsiniz:</p>
                    <ul>
                        <li>Kişisel verilerinizin işlenip işlenmediğini öğrenme</li>
                        <li>İşlenen verileriniz hakkında bilgi talep etme</li>
                        <li>Verilerin işlenme amacını ve amaca uygun kullanılıp verwendilmediğini öğrenme</li>
                        <li>Yurt içinde veya yurt dışında aktarıldığı üçüncü kişileri bilme</li>
                        <li>Verilerin eksik veya yanlış işlenmiş olması halinde düzeltilmesini isteme</li>
                        <li>Verilerin silinmesini veya yok edilmesini isteme</li>
                        <li>İşbu taleplerin verinin aktarıldığı üçüncü kişilere bildirilmesini isteme</li>
                    </ul>

                    {{-- 8. Veri Saklama --}}
                    <h2>8. Veri Saklama Süresi</h2>
                    <p>
                        Kişisel verileriniz, işlendikleri amaç için gerekli olan süre boyunca ve yasal saklama
                        yükümlülüklerini yerine getirmek amacıyla saklanır. Süre dolduğunda verileriniz güvenli bir şekilde
                        imha edilir.
                    </p>

                    {{-- 9. Üçüncü Taraf Bağlantılar --}}
                    <h2>9. Üçüncü Taraf Web Siteleri</h2>
                    <p>
                        Web sitemiz, üçüncü taraf web sitelerine bağlantılar içerebilir. Bu sitelerin gizlilik
                        politikalarından sorumlu değiliz. Bu siteleri ziyaret ettiğinizde, onların gizlilik politikalarını
                        incelemenizi öneririz.
                    </p>

                    {{-- 10. Çocukların Gizliliği --}}
                    <h2>10. Çocukların Gizliliği</h2>
                    <p>
                        Hizmetlerimiz 18 yaş altı çocuklara yönelik değildir. Bilerek 18 yaş altı çocuklardan kişisel bilgi
                        toplamıyoruz. Eğer bir ebeveyn veya vasi iseniz ve çocuğunuzun bize kişisel bilgi verdiğini
                        düşünüyorsanız, lütfen bizimle iletişime geçin.
                    </p>

                    {{-- 11. Politika Değişiklikleri --}}
                    <h2>11. Gizlilik Politikası Güncellemeleri</h2>
                    <p>
                        Bu gizlilik politikasını zaman zaman güncelleyebiliriz. Değişiklikler bu sayfada yayınlanacak ve
                        "Son Güncelleme" tarihi güncellenecektir. Önemli değişiklikler olması durumunda size e-posta ile
                        bildirim gönderilebilir.
                    </p>

                    {{-- 12. İletişim --}}
                    <h2>12. İletişim Bilgileri</h2>
                    <p>
                        Gizlilik politikamız veya kişisel verilerinizle ilgili sorularınız için bizimle iletişime
                        geçebilirsiniz:
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
                        <p class="text-sm text-slate-600">
                            <strong>Adres:</strong> {{ setting('address', 'Türkiye') }}
                        </p>
                    </div>

                    <div class="mt-12 p-6 bg-brand-50 border-l-4 border-brand-600 rounded-r-lg">
                        <p class="text-sm text-brand-900 font-semibold mb-2">
                            ✓ Bu gizlilik politikası {{ date('d.m.Y') }} tarihinde son güncellenmiştir.
                        </p>
                        <p class="text-sm text-brand-800">
                            Hizmetlerimizi kullanarak bu gizlilik politikasını kabul etmiş sayılırsınız.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection