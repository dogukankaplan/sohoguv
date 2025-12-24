import { Link } from 'react-router-dom';
import { useSettings } from '../context/SettingsContext';
import { 
    PhoneIcon, 
    EnvelopeIcon, 
    MapPinIcon, 
    ChevronRightIcon
} from '@heroicons/react/24/outline';

const navigation = {
  main: [
    { name: 'Ana Sayfa', href: '/' },
    { name: 'Hakkımızda', href: '/corporate' }, 
    { name: 'Hizmetler', href: '/services' },
    { name: 'Referanslar', href: '/references' },
    { name: 'Blog', href: '/blog' },
    { name: 'İletişim', href: '/contact' },
  ],
  services: [
    { name: 'Kamera Sistemleri', href: '/services/kamera-sistemleri' },
    { name: 'Alarm Sistemleri', href: '/services/alarm-sistemleri' },
    { name: 'Yangın İhbar', href: '/services/yangin-ihbar' },
    { name: 'Geçiş Kontrol', href: '/services/gecis-kontrol' },
  ],
  social: [
    { name: 'Facebook', href: '#', icon: (props) => <svg fill="currentColor" viewBox="0 0 24 24" {...props}><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg> },
    { name: 'Instagram', href: '#', icon: (props) => <svg fill="currentColor" viewBox="0 0 24 24" {...props}><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h-.165zm-3.77 1.795c-.99.049-1.502.23-1.722.316-.296.115-.508.254-.73.476-.222.222-.361.434-.476.73-.086.22-.267.732-.317 1.722C5.351 8.01 5.344 8.28 5.344 12c0 3.737.007 3.991.055 4.957.049.99.23 1.502.316 1.722.115.296.254.508.476.73.222.222.434.361.73.476.22.086.732.267 1.722.317.966.049 1.24.056 4.957.056 3.737 0-3.991.007 4.957.055-.99.049 1.502.23-1.722.316zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg> },
  ],
};

export default function Footer() {
  const { settings } = useSettings();

  return (
    <footer className="bg-brand-dark text-gray-300 font-sans border-t-8 border-brand-primary" aria-labelledby="footer-heading">
      <h2 id="footer-heading" className="sr-only">Footer</h2>
      
      <div className="container mx-auto px-6 py-20 lg:px-8">
        <div className="xl:grid xl:grid-cols-4 xl:gap-8">
          
          {/* BRAND */}
          <div className="space-y-8 xl:col-span-1">
             <Link to="/" className="inline-block">
                <img className="h-12 w-auto brightness-0 invert" src="/logo.png" alt="Soho Güvenlik" />
            </Link>
            <p className="text-sm leading-6 text-gray-400">
               {settings.site_description || 
                'Endüstriyel güvenlik ve otomasyon sistemlerinde profesyonel çözüm ortağınız.'}
            </p>
            <div className="flex space-x-4">
              {navigation.social.map((item) => (
                <a key={item.name} href={item.href} className="bg-gray-800 p-2 rounded hover:bg-brand-primary hover:text-white transition-all text-gray-400">
                  <span className="sr-only">{item.name}</span>
                  <item.icon className="h-5 w-5" aria-hidden="true" />
                </a>
              ))}
            </div>
          </div>

          {/* MENUS */}
          <div className="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 xl:col-span-3 xl:mt-0">
            
            {/* LINKS */}
            <div>
              <h3 className="text-sm font-bold leading-6 text-white uppercase tracking-wider mb-6 border-l-4 border-brand-primary pl-3">
                 HIZLI ERİŞİM
              </h3>
              <ul role="list" className="space-y-3">
                {navigation.main.map((item) => (
                  <li key={item.name}>
                    <Link to={item.href} className="text-sm leading-6 text-gray-400 hover:text-brand-primary hover:pl-2 transition-all flex items-center gap-1 group">
                        <ChevronRightIcon className="h-3 w-3 text-gray-600 group-hover:text-brand-primary" />
                        {item.name}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>

            {/* SERVICES */}
            <div>
               <h3 className="text-sm font-bold leading-6 text-white uppercase tracking-wider mb-6 border-l-4 border-brand-primary pl-3">
                 HİZMETLERİMİZ
              </h3>
              <ul role="list" className="space-y-3">
                {navigation.services.map((item) => (
                  <li key={item.name}>
                    <Link to={item.href} className="text-sm leading-6 text-gray-400 hover:text-brand-primary hover:pl-2 transition-all flex items-center gap-1 group">
                      <ChevronRightIcon className="h-3 w-3 text-gray-600 group-hover:text-brand-primary" />
                      {item.name}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>

            {/* CONTACT */}
            <div>
               <h3 className="text-sm font-bold leading-6 text-white uppercase tracking-wider mb-6 border-l-4 border-brand-primary pl-3">
                 İLETİŞİM
              </h3>
              <ul role="list" className="space-y-6">
                <li className="flexgap-x-3">
                   <div className="flex gap-4">
                       <MapPinIcon className="h-6 w-6 flex-none text-brand-primary" aria-hidden="true" />
                       <span className="text-sm leading-6 text-gray-400">
                         {settings.contact_address || 'İstanbul, Türkiye'}
                       </span>
                   </div>
                </li>
                 <li>
                    <a href={`tel:${settings.contact_phone || '+905551234567'}`} className="flex gap-4 items-center group">
                        <PhoneIcon className="h-6 w-6 flex-none text-brand-primary group-hover:text-white transition-colors" aria-hidden="true" />
                        <span className="text-sm leading-6 text-gray-400 group-hover:text-white transition-colors">{settings.contact_phone || '+90 (555) 123 45 67'}</span>
                    </a>
                </li>
                <li>
                    <a href={`mailto:${settings.contact_email || 'info@sohoguvenlik.com'}`} className="flex gap-4 items-center group">
                        <EnvelopeIcon className="h-6 w-6 flex-none text-brand-primary group-hover:text-white transition-colors" aria-hidden="true" />
                        <span className="text-sm leading-6 text-gray-400 group-hover:text-white transition-colors">{settings.contact_email || 'info@sohoguvenlik.com'}</span>
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div className="bg-black/30 py-6 border-t border-white/5">
          <div className="container mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
               <p className="text-xs text-gray-500 text-center md:text-left">
                  &copy; {new Date().getFullYear()} Soho Güvenlik Sistemleri.
               </p>
               <div className="flex gap-6 text-xs text-gray-500">
                   <Link to="/privacy" className="hover:text-white">Gizlilik</Link>
                   <Link to="/terms" className="hover:text-white">Kullanım Şartları</Link>
               </div>
          </div>
      </div>
    </footer>
  );
}
