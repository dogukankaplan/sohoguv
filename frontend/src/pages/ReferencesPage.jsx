import { useState, useEffect } from 'react';
import api from '../lib/axios';
import PageHero from '../components/PageHero';
import Seo from '../components/Seo';
import LoadingScreen from '../components/LoadingScreen';

export default function ReferencesPage() {
  const [references, setReferences] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchReferences = async () => {
      try {
        const response = await api.get('/public/references');
        setReferences(response.data);
      } catch (error) {
        console.error('Failed to fetch references', error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchReferences();
  }, []);

  if (isLoading) return <div className="h-screen flex items-center justify-center bg-white"><div className="w-16 h-1 bg-brand-primary animate-pulse"></div></div>;

  return (
    <>
      <Seo 
        title="Referanslarımız | SOHO Güvenlik İzmir" 
        description="İzmir ve Türkiye genelinde başarıyla tamamladığımız güvenlik ve otomasyon projeleri. Bizi tercih eden mutlu müşterilerimiz."
        keywords="soho güvenlik referanslar, izmir kamera referans, güvenlik referansları"
      />
      
      <PageHero 
        title="Referanslarımız" 
        subtitle="Bizi tercih eden, güvenliğine değer katan iş ortaklarımızdan bazıları."
        bgImage="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop"
      />

      <div className="bg-white py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
            {references.map((ref) => (
              <div key={ref.id} className="flex flex-col items-center justify-center p-8 bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:border-brand-primary transition duration-300 rounded-lg group">
                {ref.media?.[0] ? (
                    <img
                      className="max-h-24 w-auto object-contain mb-6 filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition duration-300"
                      src={ref.media[0].original_url}
                      alt={ref.title}
                    />
                ) : (
                    <div className="h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-6 text-gray-400 font-bold">LOGO</div>
                )}
                <h3 className="text-lg font-bold text-gray-900 text-center uppercase">{ref.title}</h3>
                {ref.url && (
                    <a href={ref.url} target="_blank" rel="noreferrer" className="text-sm text-brand-primary font-semibold hover:text-brand-dark mt-2 uppercase tracking-wide">
                        WEB SİTESİ
                    </a>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>
    </>
  );
}
