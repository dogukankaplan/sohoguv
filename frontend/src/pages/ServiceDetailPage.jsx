import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import api from '../lib/axios';
import PageHero from '../components/PageHero';
import Seo from '../components/Seo';
import { ArrowLongLeftIcon, CheckCircleIcon } from '@heroicons/react/24/outline';

export default function ServiceDetailPage() {
  const { slug } = useParams();
  const [service, setService] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchService = async () => {
      try {
        const response = await api.get(`/public/services/${slug}`);
        setService(response.data);
      } catch (error) {
        console.error('Failed to fetch service', error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchService();
  }, [slug]);

  if (isLoading) {
    return (
      <div className="flex items-center justify-center min-h-screen">
        <div className="w-16 h-1 bg-brand-primary animate-pulse"></div>
      </div>
    );
  }

  if (!service) {
    return (
      <div className="flex flex-col items-center justify-center min-h-screen">
        <h1 className="text-2xl font-bold text-gray-900 mb-4">Hizmet Bulunamadı</h1>
        <Link to="/services" className="text-brand-primary hover:text-brand-dark">
          ← Hizmetlere Dön
        </Link>
      </div>
    );
  }

  return (
    <>
      <Seo
        title={`${service.title} | SOHO Güvenlik`}
        description={service.summary || service.content?.substring(0, 155)}
        keywords={`${service.title}, güvenlik sistemleri, İzmir`}
      />

      {/* Service Schema.org Structured Data */}
      <script type="application/ld+json">
        {JSON.stringify({
          "@context": "https://schema.org",
          "@type": "Service",
          "name": service.title,
          "description": service.summary || service.content,
          "provider": {
            "@type": "LocalBusiness",
            "name": "SOHO Güvenlik Sistemleri",
            "address": {
              "@type": "PostalAddress",
              "addressLocality": "İzmir",
              "addressCountry": "TR"
            }
          },
          "areaServed": {
            "@type": "City",
            "name": "İzmir"
          },
          "image": service.media?.[0]?.original_url,
          "url": window.location.href
        })}
      </script>

      <PageHero
        title={service.title}
        subtitle="Profesyonel Güvenlik Çözümleri"
        bgImage={service.media?.[0]?.original_url}
      />

      <div className="bg-white py-16 lg:py-24">
        <div className="container mx-auto px-4 lg:px-8">
          <div className="mx-auto max-w-4xl">
            {/* Back Button */}
            <Link 
              to="/services" 
              className="inline-flex items-center gap-2 text-sm font-semibold text-brand-primary hover:text-brand-dark mb-8 group"
            >
              <ArrowLongLeftIcon className="h-5 w-5 group-hover:-translate-x-1 transition-transform" />
              Tüm Hizmetler
            </Link>

            {/* Service Image */}
            {service.media?.[0] && (
              <div className="mb-12 rounded-3xl overflow-hidden shadow-xl">
                <img
                  className="w-full h-96 object-cover"
                  src={service.media[0].original_url}
                  alt={service.title}
                />
              </div>
            )}

            {/* Service Summary */}
            {service.summary && (
              <div className="bg-brand-light/30 border-l-4 border-brand-primary p-6 rounded-r-2xl mb-12">
                <p className="text-lg text-gray-700 leading-relaxed">
                  {service.summary}
                </p>
              </div>
            )}

            {/* Service Content */}
            <div className="prose prose-lg max-w-none">
              <div className="text-gray-700 leading-relaxed whitespace-pre-line">
                {service.content}
              </div>
            </div>

            {/* Features/Benefits (if content is long enough, split it) */}
            <div className="mt-16 grid grid-cols-1 md:grid-cols-2 gap-6">
              {[
                { title: 'Profesyonel Kurulum', desc: 'Uzman ekibimiz tarafından güvenli montaj' },
                { title: 'Garanti', desc: 'Tüm ürün ve hizmetlerde garanti belgesi' },
                { title: '7/24 Destek', desc: 'Her zaman ulaşılabilir teknik destek' },
                { title: 'Uygun Fiyat', desc: 'Kaliteli hizmet, rekabetçi fiyatlar' },
              ].map((feature, idx) => (
                <div key={idx} className="flex gap-4 items-start p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                  <CheckCircleIcon className="h-6 w-6 text-brand-primary flex-shrink-0 mt-1" />
                  <div>
                    <h3 className="font-bold text-gray-900 mb-1">{feature.title}</h3>
                    <p className="text-sm text-gray-600">{feature.desc}</p>
                  </div>
                </div>
              ))}
            </div>

            {/* CTA */}
            <div className="mt-16 bg-gradient-to-r from-brand-primary to-brand-glow p-8 rounded-3xl text-center text-white">
              <h2 className="text-3xl font-bold mb-4">Bu Hizmet İlginizi mi Çekti?</h2>
              <p className="text-lg mb-6 opacity-90">
                Uzman ekibimizle görüşün, ücretsiz keşif ve teklif alın.
              </p>
              <Link
                to="/contact"
                className="inline-block bg-white text-brand-primary px-8 py-4 rounded-full font-bold hover:bg-brand-dark hover:text-white transition-all shadow-lg"
              >
                İletişime Geç
              </Link>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
