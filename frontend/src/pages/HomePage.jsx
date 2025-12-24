import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { Helmet } from 'react-helmet-async';
import { motion } from 'framer-motion';
import Slider from '../components/Slider';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import axios from '../lib/axios';
import { 
  ShieldCheckIcon, 
  ClockIcon, 
  UserGroupIcon,
  CpuChipIcon,
  CheckBadgeIcon,
  PhoneIcon
} from '@heroicons/react/24/outline';

const HomePage = () => {
  const [services, setServices] = useState([]);
  const [blogs, setBlogs] = useState([]);
  const [references, setReferences] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [servicesRes, blogsRes, referencesRes] = await Promise.all([
          axios.get('/public/services'),
          axios.get('/public/blogs'),
          axios.get('/public/references')
        ]);
        setServices(Array.isArray(servicesRes.data) ? servicesRes.data : (servicesRes.data?.data || []));
        setBlogs(Array.isArray(blogsRes.data) ? blogsRes.data : (blogsRes.data?.data || []));
        setReferences(Array.isArray(referencesRes.data) ? referencesRes.data : (referencesRes.data?.data || []));
      } catch (error) {
        console.error('Veri yükleme hatası:', error);
        setServices([]);
        setBlogs([]);
        setReferences([]);
      } finally {
        setLoading(false);
      }
    };
    fetchData();
  }, []);

  const stats = [
    { id: 1, name: 'Yıllık Tecrübe', value: '15+', icon: ClockIcon },
    { id: 2, name: 'Tamamlanan Proje', value: '500+', icon: CheckBadgeIcon },
    { id: 3, name: 'Mutlu Müşteri', value: '1000+', icon: UserGroupIcon },
    { id: 4, name: 'Uzman Personel', value: '25+', icon: CpuChipIcon },
  ];

  const features = [
    {
      name: 'Profes yonel Montaj',
      description: 'Sertifikalı teknik ekibimizle en yüksek standartlarda kurulum hizmeti sunuyoruz.',
      icon: UserGroupIcon,
    },
    {
      name: '7/24 Teknik Destek',
      description: 'Kesintisiz hizmet için her an ulaşabileceğiniz destek ekibimiz yanınızda.',
      icon: PhoneIcon,
    },
    {
      name: 'Garantili Ürünler',
      description: 'Dünya markası ürünlerle uzun ömürlü ve güvenilir çözümler.',
      icon: ShieldCheckIcon,
    },
    {
      name: 'Akıllı Teknoloji',
      description: 'En son teknoloji ürünler ve IoT entegrasyonlu akıllı sistemler.',
      icon: CpuChipIcon,
    },
  ];

  if (loading) return (
    <div className="flex justify-center items-center h-screen">
      <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-brand-primary"></div>
    </div>
  );

  return (
    <>
      <Helmet>
        {/* Primary Meta Tags */}
        <title>İzmir Güvenlik Sistemleri | SOHO Kamera ve Alarm Sistemleri</title>
        <meta name="title" content="İzmir Güvenlik Sistemleri | SOHO Kamera ve Alarm Sistemleri" />
        <meta name="description" content="İzmir'de profesyonel güvenlik kamera sistemleri, hırsız alarm, yangın ihbar ve geçiş kontrol sistemleri. 15 yıllık tecrübe ile İzmir ve Ege bölgesinde güvenlik çözümleri." />
        <meta name="keywords" content="izmir kamera sistemleri, izmir güvenlik sistemleri, izmir güvenlik, kamera sistemleri izmir, güvenlik kamera izmir, alarm sistemleri izmir, yangın ihbar sistemleri, geçiş kontrol sistemleri, soho güvenlik, hikvision izmir, dahua izmir" />
        <meta name="author" content="SOHO Güvenlik Sistemleri" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="https://sohoguvenliksistemleri.com.tr/" />

        {/* Open Graph / Facebook */}
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://sohoguvenliksistemleri.com.tr/" />
        <meta property="og:title" content="İzmir Güvenlik Sistemleri | SOHO Kamera ve Alarm Sistemleri" />
        <meta property="og:description" content="İzmir'de profesyonel güvenlik kamera sistemleri, hırsız alarm, yangın ihbar ve geçiş kontrol sistemleri. 15 yıllık tecrübe." />
        <meta property="og:image" content="https://sohoguvenliksistemleri.com.tr/og-image.jpg" />
        <meta property="og:locale" content="tr_TR" />
        <meta property="og:site_name" content="SOHO Güvenlik Sistemleri" />

        {/* Twitter */}
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="https://sohoguvenliksistemleri.com.tr/" />
        <meta property="twitter:title" content="İzmir Güvenlik Sistemleri | SOHO Kamera ve Alarm Sistemleri" />
        <meta property="twitter:description" content="İzmir'de profesyonel güvenlik kamera sistemleri, hırsız alarm, yangın ihbar ve geçiş kontrol sistemleri." />
        <meta property="twitter:image" content="https://sohoguvenliksistemleri.com.tr/og-image.jpg" />

        {/* Geo Tags for Local SEO */}
        <meta name="geo.region" content="TR-35" />
        <meta name="geo.placename" content="İzmir" />
        <meta name="geo.position" content="38.423734;27.142826" />
        <meta name="ICBM" content="38.423734, 27.142826" />

        {/* Structured Data - LocalBusiness */}
        <script type="application/ld+json">
          {JSON.stringify({
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "@id": "https://sohoguvenliksistemleri.com.tr/#organization",
            "name": "SOHO Güvenlik Sistemleri",
            "image": "https://sohoguvenliksistemleri.com.tr/logo.png",
            "description": "İzmir'de profesyonel güvenlik kamera sistemleri, hırsız alarm, yangın ihbar ve geçiş kontrol sistemleri kurulumu ve satışı",
            "telephone": "+90-232-XXX-XXXX",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "İzmir",
              "addressLocality": "İzmir",
              "addressRegion": "İzmir",
              "postalCode": "35000",
              "addressCountry": "TR"
            },
            "geo": {
              "@type": "GeoCoordinates",
              "latitude": "38.423734",
              "longitude": "27.142826"
            },
            "url": "https://sohoguvenliksistemleri.com.tr",
            "priceRange": "₺₺",
            "areaServed": ["İzmir", "Ege Bölgesi"],
            "hasOfferCatalog": {
              "@type": "OfferCatalog",
              "name": "Güvenlik Sistemleri",
              "itemListElement": [
                {
                  "@type": "Offer",
                  "itemOffered": {
                    "@type": "Service",
                    "name": "Güvenlik Kamera Sistemleri",
                    "description": "İzmir kamera sistemleri kurulumu ve satışı"
                  }
                },
                {
                  "@type": "Offer",
                  "itemOffered": {
                    "@type": "Service",
                    "name": "Alarm Sistemleri",
                    "description": "Hırsız alarm ve yangın ihbar sistemleri"
                  }
                }
              ]
            }
          })}
        </script>

        {/* Structured Data - Organization */}
        <script type="application/ld+json">
          {JSON.stringify({
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "SOHO Güvenlik Sistemleri",
            "url": "https://sohoguvenliksistemleri.com.tr",
            "logo": "https://sohoguvenliksistemleri.com.tr/logo.png",
            "contactPoint": {
              "@type": "ContactPoint",
              "telephone": "+90-232-XXX-XXXX",
              "contactType": "customer service",
              "areaServed": "TR",
              "availableLanguage": "Turkish"
            },
            "sameAs": [
              "https://www.facebook.com/sohoguvenlik",
              "https://www.instagram.com/sohoguvenlik"
            ]
          })}
        </script>

        {/* Structured Data - WebSite */}
        <script type="application/ld+json">
          {JSON.stringify({
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "SOHO Güvenlik Sistemleri",
            "url": "https://sohoguvenliksistemleri.com.tr",
            "potentialAction": {
              "@type": "SearchAction",
              "target": "https://sohoguvenliksistemleri.com.tr/search?q={search_term_string}",
              "query-input": "required name=search_term_string"
            }
          })}
        </script>
      </Helmet>

      {/* Hero Slider */}
      <section className="relative">
        <Slider />
      </section>

      {/* Stats Section */}
      <section className="relative bg-white py-16 -mt-20 z-10">
        <div className="container mx-auto px-4">
          <div className="bg-gradient-to-r from-brand-primary to-brand-dark rounded-2xl shadow-2xl p-8 md:p-12">
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
              {stats.map((stat, index) => (
                <motion.div
                  key={stat.id}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.5, delay: index * 0.1 }}
                  viewport={{ once: true }}
                  className="text-center"
                >
                  <stat.icon className="w-12 h-12 mx-auto mb-4 text-white" />
                  <div className="text-4xl md:text-5xl font-bold text-white mb-2">{stat.value}</div>
                  <div className="text-sm md:text-base text-white/90 font-medium">{stat.name}</div>
                </motion.div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center mb-16"
          >
            <h2 className="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
              İzmir'de Güvenlik Sistemleri Neden SOHO?
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              İzmir ve Ege bölgesinde 15 yıllık deneyimimiz ve profesyonel ekibimizle güvenliğinizi en üst seviyede tutuyoruz
            </p>
          </motion.div>

          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {features.map((feature, index) => (
              <motion.div
                key={feature.name}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
                className="relative group"
              >
                <div className="h-full bg-white rounded-xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand-primary">
                  <div className="w-16 h-16 bg-gradient-to-br from-brand-primary to-brand-dark rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <feature.icon className="w-8 h-8 text-white" />
                  </div>
                  <h3 className="text-xl font-bold text-gray-900 mb-3">{feature.name}</h3>
                  <p className="text-gray-600 leading-relaxed">{feature.description}</p>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section className="py-20 bg-white">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center mb-16"
          >
            <h2 className="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
              İzmir Kamera Sistemleri ve Güvenlik Hizmetlerimiz
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Güvenlik kamera sistemleri, alarm ve yangın ihbar sistemleri ile İzmir'de profesyonel çözümler sunuyoruz
            </p>
          </motion.div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {services.slice(0, 6).map((service, index) => (
              <motion.div
                key={service.id}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <Link 
                  to={`/hizmetlerimiz/${service.slug}`} 
                  className="group block bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand-primary h-full"
                >
                  <div className="relative h-64 overflow-hidden bg-gray-100">
                    <img 
                      src={service.image || service.media?.[0]?.original_url || '/logo.png'} 
                      alt={service.title} 
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  </div>
                  <div className="p-6">
                    <h3 className="text-2xl font-bold text-gray-900 mb-3 group-hover:text-brand-primary transition-colors">
                      {service.title}
                    </h3>
                    <p className="text-gray-600 line-clamp-3 leading-relaxed">
                      {service.short_description || service.summary || ''}
                    </p>
                    <div className="mt-4 flex items-center text-brand-primary font-semibold">
                      <span>Detayları İncele</span>
                      <svg className="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                      </svg>
                    </div>
                  </div>
                </Link>
              </motion.div>
            ))}
          </div>

          <div className="text-center mt-12">
            <Link 
              to="/hizmetlerimiz" 
              className="inline-flex items-center px-8 py-4 bg-gradient-to-r from-brand-primary to-brand-dark text-white text-lg font-semibold rounded-full hover:shadow-xl transition-all duration-300 hover:scale-105"
            >
              Tüm Hizmetlerimizi İnceleyin
              <svg className="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
              </svg>
            </Link>
          </div>
        </div>
      </section>

      {/* References Section */}
      <section className="py-16 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
              Referanslarımız
            </h2>
            <p className="text-lg text-gray-600">
              Güvenimizi kazanan markalar ve kurumlar
            </p>
          </motion.div>

          <Swiper
            modules={[Autoplay]}
            spaceBetween={30}
            slidesPerView={2}
            loop={true}
            autoplay={{ delay: 2500, disableOnInteraction: false }}
            breakpoints={{
              640: { slidesPerView: 3 },
              768: { slidesPerView: 4 },
              1024: { slidesPerView: 6 },
            }}
            className="items-center"
          >
            {references.map((ref) => (
              <SwiperSlide key={ref.id}>
                <div className="p-6 bg-white rounded-lg grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100 hover:shadow-lg">
                  <img 
                    src={ref.image_url || ref.image} 
                    alt={ref.title} 
                    className="max-h-20 mx-auto object-contain" 
                  />
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </section>
      
      {/* Blog Section */}
      <section className="py-20 bg-white">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="flex justify-between items-end mb-12"
          >
            <div>
              <h2 className="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Güncel Blog Yazıları
              </h2>
              <p className="text-xl text-gray-600">
                Güvenlik sistemleri hakkında en son haberler
              </p>
            </div>
            <Link 
              to="/blog" 
              className="hidden md:flex items-center text-brand-primary font-semibold hover:underline text-lg"
            >
              Tümünü Gör
              <svg className="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
              </svg>
            </Link>
          </motion.div>

          <div className="grid md:grid-cols-3 gap-8">
            {blogs.slice(0, 3).map((blog, index) => (
              <motion.div
                key={blog.id}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <Link to={`/blog/${blog.slug}`} className="group block h-full">
                  <div className="relative rounded-xl overflow-hidden shadow-lg mb-6 h-64 bg-gray-100">
                    <img 
                      src={blog.image || blog.media?.[0]?.original_url || '/logo.png'} 
                      alt={blog.title} 
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div className="absolute top-4 left-4 bg-brand-primary text-white text-xs px-4 py-2 rounded-full uppercase font-bold tracking-wider">
                      Blog
                    </div>
                  </div>
                  <h3 className="text-2xl font-bold text-gray-900 mb-3 group-hover:text-brand-primary transition-colors leading-tight">
                    {blog.title}
                  </h3>
                  <p className="text-gray-600 line-clamp-2 leading-relaxed">
                    {blog.short_description || blog.excerpt || ''}
                  </p>
                </Link>
              </motion.div>
            ))}
          </div>

          <div className="text-center mt-12 md:hidden">
            <Link 
              to="/blog" 
              className="inline-flex items-center text-brand-primary font-semibold hover:underline text-lg"
            >
              Tümünü Gör
              <svg className="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
              </svg>
            </Link>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="relative py-24 bg-gradient-to-r from-brand-primary to-brand-dark overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute inset-0" style={{ backgroundImage: 'url("data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")' }}></div>
        </div>
        <div className="container mx-auto px-4 relative z-10">
          <motion.div
            initial={{ opacity: 0, scale: 0.95 }}
            whileInView={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center max-w-4xl mx-auto"
          >
            <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-6">
              Güvenliğiniz İçin Hemen Harekete Geçin
            </h2>
            <p className="text-xl text-white/90 mb-10 leading-relaxed">
              Profesyonel güvenlik çözümlerimiz hakkında detaylı bilgi almak ve 
              ücretsiz keşif randevusu oluşturmak için bizimle iletişime geçin.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                to="/iletisim"
                className="inline-flex items-center justify-center px-8 py-4 bg-white text-brand-dark text-lg font-bold rounded-full hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-xl"
              >
                <PhoneIcon className="w-6 h-6 mr-2" />
                İletişime Geç
              </Link>
              <Link
                to="/teklif"
                className="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white text-lg font-bold rounded-full hover:bg-white hover:text-brand-dark transition-all duration-300 hover:scale-105"
              >
                Teklif Al
                <svg className="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                </svg>
              </Link>
            </div>
          </motion.div>
        </div>
      </section>
    </>
  );
};

export default HomePage;
