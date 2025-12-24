import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../lib/axios';
import PageHero from '../components/PageHero';
import Seo from '../components/Seo';
import LoadingScreen from '../components/LoadingScreen';

export default function ServicesPage() {
  const [services, setServices] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchServices = async () => {
      try {
        const response = await api.get('/public/services');
        setServices(response.data);
      } catch (error) {
        console.error('Failed to fetch services', error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchServices();
  }, []);

  if (isLoading) return <div className="h-screen flex items-center justify-center bg-white"><div className="w-16 h-1 bg-brand-primary animate-pulse"></div></div>;

  return (
    <>
      <Seo 
        title="Güvenlik Hizmetlerimiz | SOHO Güvenlik" 
        description="Kamera sistemleri, hırsız alarmı, yangın ihbar, geçiş kontrol ve akıllı ev sistemleri çözümlerimiz. İzmir ve Ege bölgesi profesyonel destek."
        keywords="kamera sistemleri izmir, alarm sistemleri, yangın ihbar, geçiş kontrol, akıllı bina, soho hizmetler"
      />
      
      <PageHero 
        title="Hizmetlerimiz" 
        subtitle="Endüstriyel, ticari ve konut projeleriniz için uçtan uca güvenlik ve otomasyon çözümleri."
        bgImage="https://images.unsplash.com/photo-1557597774-9d273605dfa9?q=80&w=2070&auto=format&fit=crop"
      />

      <div className="bg-white py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            {services.map((service) => (
              <article key={service.id} className="flex flex-col items-start justify-between group">
                <div className="relative w-full overflow-hidden rounded-2xl">
                  <img
                    src={service.media?.[0]?.original_url || '/logo.png'}
                    alt={service.title}
                    className="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition-transform duration-500 group-hover:scale-110"
                  />
                  <div className="absolute inset-0 ring-1 ring-inset ring-brand-dark/10" />
                </div>
                <div className="max-w-xl">
                  <div className="group relative">
                    <h3 className="mt-6 text-xl font-bold leading-6 text-brand-dark group-hover:text-brand-primary transition-colors uppercase">
                      <Link to={`/services/${service.slug}`}>
                        <span className="absolute inset-0" />
                        {service.title}
                      </Link>
                    </h3>
                    <p className="mt-4 line-clamp-3 text-sm leading-6 text-gray-600">{service.summary}</p>
                  </div>
                  <div className="mt-4 flex items-center gap-x-4 text-xs font-bold uppercase text-brand-primary tracking-wider">
                      <span>Detayları İncele &rarr;</span>
                  </div>
                </div>
              </article>
            ))}
          </div>
        </div>
      </div>
    </>
  );
}
