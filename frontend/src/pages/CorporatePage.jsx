import { motion } from 'framer-motion';
import { CheckCircleIcon, UserGroupIcon, GlobeAltIcon, ShieldCheckIcon } from '@heroicons/react/24/outline';
import Seo from '../components/Seo';

const stats = [
  { id: 1, name: 'Yıllık Tecrübe', value: '15+' },
  { id: 2, name: 'Tamamlanan Proje (İzmir & Ege)', value: '500+' },
  { id: 3, name: 'Mutlu Müşteri', value: '1000+' },
  { id: 4, name: 'Uzman Personel', value: '25+' },
];

const values = [
  {
    name: 'Güvenilirlik ve Kalite',
    description: 'İzmir güvenlik sistemleri sektöründe en güvenilir marka olma vizyonuyla çalışıyoruz.',
    icon: ShieldCheckIcon,
  },
  {
    name: 'Profesyonel Teknik Ekip',
    description: 'İzmir kamera sistemleri montajında uzman, sertifikalı teknisyenlerimizle hizmetinizdeyiz.',
    icon: UserGroupIcon,
  },
  {
    name: 'Dünya Standartları',
    description: 'Global marka kamera ve alarm ürünleri ile tesislerinizi koruma altına alıyoruz.',
    icon: GlobeAltIcon,
  },
];

export default function CorporatePage() {
  return (
    <div className="bg-white">
      <Seo 
         title="Kurumsal | İzmir Güvenlik Sistemleri" 
         description="SOHO Güvenlik, İzmir ve Ege bölgesinde 15 yıldır profesyonel kamera sistemleri, hırsız alarmı ve yangın ihbar sistemleri hizmeti sunmaktadır."
         keywords="izmir güvenlik firması, izmir kamera sistemleri firmaları, soho güvenlik kurumsal, güvenlik çözümleri"
      />

      {/* Hero Section */}
      <div className="relative isolate overflow-hidden bg-brand-dark py-24 sm:py-32">
        <div className="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.brand.primary),theme(colors.brand.dark))] opacity-20" />
        <div className="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-brand-dark shadow-xl shadow-brand-primary/10 ring-1 ring-brand-primary/10 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center" />
        
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto max-w-2xl lg:mx-0">
            <motion.h2 
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8 }}
                className="text-4xl font-black tracking-tight text-white sm:text-6xl uppercase"
            >
              Hakkımızda
            </motion.h2>
            <motion.p 
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8, delay: 0.2 }}
                className="mt-6 text-lg leading-8 text-gray-300"
            >
              SOHO Güvenlik Sistemleri, <b>İzmir güvenlik sistemleri</b> alanında endüstriyel tesisler, ticari yapılar ve konut projeleri için yüksek teknolojili güvenlik ve otomasyon çözümleri sunan lider firmadır.
            </motion.p>
          </div>
          <div className="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
            <div className="grid grid-cols-1 gap-x-8 gap-y-6 text-base font-semibold leading-7 text-white sm:grid-cols-2 md:flex lg:gap-x-10">
              <a href="#mission" className="hover:text-brand-primary transition-colors">Misyonumuz <span aria-hidden="true">&rarr;</span></a>
              <a href="#values" className="hover:text-brand-primary transition-colors">Değerlerimiz <span aria-hidden="true">&rarr;</span></a>
              <a href="#history" className="hover:text-brand-primary transition-colors">Tarihçemiz <span aria-hidden="true">&rarr;</span></a>
              <a href="/contact" className="hover:text-brand-primary transition-colors">Bize Ulaşın <span aria-hidden="true">&rarr;</span></a>
            </div>
            <dl className="mt-16 grid grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
              {stats.map((stat) => (
                <div key={stat.name} className="flex flex-col-reverse">
                  <dt className="text-base leading-7 text-gray-300">{stat.name}</dt>
                  <dd className="text-2xl font-bold leading-9 tracking-tight text-white">{stat.value}</dd>
                </div>
              ))}
            </dl>
          </div>
        </div>
      </div>

      {/* Content Section */}
      <div className="mx-auto max-w-7xl px-6 lg:px-8 py-24 sm:py-32">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
              <div>
                  <h2 className="text-3xl font-black text-brand-dark uppercase mb-6 relative inline-block">
                      Kurumsal Kimlik
                      <span className="absolute -bottom-2 left-0 w-1/3 h-1 bg-brand-primary"></span>
                  </h2>
                  <div className="space-y-6 text-gray-600 leading-relaxed">
                      <p>
                          15 yılı aşkın süredir güvenlik sektöründe faaliyet gösteren SOHO Güvenlik, teknolojik gelişmeleri yakından takip ederek müşterilerine en yenilikçi çözümleri sunmayı ilke edinmiştir.
                      </p>
                      <p>
                          Kamera sistemlerinden yangın algılamaya, geçiş kontrolden akıllı bina otomasyonlarına kadar geniş bir yelpazede hizmet veriyoruz. Önceliğimiz, müşterilerimizin can ve mal güvenliğini en üst seviyede korumaktır.
                      </p>
                      <p>
                          Sadece ürün satışı değil, proje danışmanlığı, keşif, montaj ve satış sonrası teknik destek hizmetlerimizle de yanınızdayız. 7/24 aktif servis ağımızla iş sürekliliğinizi garanti altına alıyoruz.
                      </p>
                  </div>
              </div>
              <div className="relative">
                   <div className="aspect-[4/3] overflow-hidden bg-gray-100 rounded-2xl">
                       <img 
                           src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" 
                           alt="Ofisimiz" 
                           className="object-cover w-full h-full"
                       />
                   </div>
                   <div className="absolute -bottom-6 -right-6 w-2/3 bg-brand-light p-8 rounded-lg shadow-xl border-l-4 border-brand-primary">
                        <p className="font-bold text-brand-dark text-lg italic">
                            "Güvenliğiniz, bizim en büyük taahhüdümüzdür."
                        </p>
                   </div>
              </div>
          </div>
      </div>

      {/* Values Section */}
      <div id="values" className="bg-brand-light py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto max-w-2xl lg:text-center">
            <h2 className="text-base font-semibold leading-7 text-brand-primary uppercase tracking-widest">Neden Biz?</h2>
            <p className="mt-2 text-3xl font-black tracking-tight text-brand-dark sm:text-4xl uppercase">
              Temel Değerlerimiz
            </p>
            <p className="mt-6 text-lg leading-8 text-gray-600">
              Bizi sektördeki diğer firmalardan ayıran ve başarımızın temelini oluşturan prensiplerimiz.
            </p>
          </div>
          <div className="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
              {values.map((feature) => (
                <div key={feature.name} className="flex flex-col relative bg-white p-8 shadow-sm hover:shadow-md transition-shadow">
                  <dt className="flex items-center gap-x-3 text-base font-bold leading-7 text-brand-dark uppercase">
                    <feature.icon className="h-5 w-5 flex-none text-brand-primary" aria-hidden="true" />
                    {feature.name}
                  </dt>
                  <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                    <p className="flex-auto">{feature.description}</p>
                  </dd>
                </div>
              ))}
            </dl>
          </div>
        </div>
      </div>

    </div>
  );
}
