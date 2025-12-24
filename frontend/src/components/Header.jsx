import { useState, useEffect, Fragment } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { Dialog, Popover, Transition } from '@headlessui/react';
import { Bars3Icon, XMarkIcon, ChevronDownIcon, PhoneIcon, EnvelopeIcon } from '@heroicons/react/24/outline';
import { useSettings } from '../context/SettingsContext';
import api from '../lib/axios';


// Hardcoded fallback
const DEFAULT_NAVIGATION = [
  { name: 'ANA SAYFA', href: '/' },
  { name: 'KURUMSAL', href: '/corporate' },
  { name: 'HİZMETLERİMİZ', href: '/services', isDropdown: true }, // Logic: if this matches a dynamic item, keep dropdown? Or manage dropdowns dynamically?
  { name: 'PROJELER', href: '/references' },
  { name: 'BLOG', href: '/blog' },
  { name: 'İLETİŞİM', href: '/contact' },
];

export default function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [services, setServices] = useState([]);
  const [menuItems, setMenuItems] = useState([]); // Store fetched menu items
  const [scrolled, setScrolled] = useState(false);
  const { settings } = useSettings();
  const location = useLocation();

  useEffect(() => {
    const fetchServices = async () => {
        try {
            const response = await api.get('/public/services');
            setServices(Array.isArray(response.data) ? response.data : response.data.data || []);
        } catch (err) {
            console.error("Failed to fetch menu services", err);
        }
    };
    
    const fetchMenus = async () => {
        try {
            const response = await api.get('/public/menus');
            // Assuming the API returns grouped items: { header: [...], footer: [...] }
            // OR flat list. The controller I wrote does `->groupBy('type')`.
            // So response.data will have keys like 'header', 'footer_quick', etc.
            if (response.data && response.data.header) {
                setMenuItems(response.data.header);
            } else {
                 setMenuItems([]); // Or fallback to default? If empty db, use default
            }
        } catch (err) {
            console.error("Failed to fetch dynamic menus", err);
        }
    };

    fetchServices();
    fetchMenus();

    const handleScroll = () => {
        setScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);
  
  // Decide which navigation to use: Dynamic or Default
  const currentNavigation = menuItems.length > 0 ? menuItems : DEFAULT_NAVIGATION;

  const isActive = (path) => location.pathname === path;

  // Glass effect classes
  const headerClasses = `fixed w-full z-50 transition-all duration-300 font-sans ${
    scrolled 
      ? 'bg-white/90 backdrop-blur-md shadow-glass py-2' 
      : 'bg-transparent py-4'
  }`;

  const textColorClass = (scrolled || location.pathname !== '/') ? 'text-gray-800' : 'text-white';
  const logoBrightness = (scrolled || location.pathname !== '/') ? 'brightness-100' : 'brightness-0 invert';

  // Force dark text on non-home pages if header is transparent (safety check) - but actually standardizing on glass/white background is safer for subpages.
  // Strategy: For Home Page with Hero, transparent at top. For others, always white/glass.
  const isHome = location.pathname === '/';
  
  const finalHeaderClass = isHome 
      ? headerClasses 
      : 'fixed w-full z-50 transition-all duration-300 font-sans bg-white/95 backdrop-blur-md shadow-sm py-2';

  const finalTextColor = isHome && !scrolled ? 'text-white' : 'text-gray-800';
  const finalLogoClass = isHome && !scrolled 
      ? 'h-12 w-auto object-contain brightness-0 invert drop-shadow-md' 
      : 'h-12 w-auto object-contain';

  return (
    <header className={finalHeaderClass}>
      <div className="container mx-auto px-4 lg:px-8 flex items-center justify-between">
            
        {/* Logo Section */}
        <div className="flex lg:flex-1">
            <Link to="/" className="-m-1.5 p-1.5 flex items-center gap-3 group">
                <img 
                    className={`${finalLogoClass} transition-all duration-300 group-hover:scale-105`} 
                    src="/logo.png" 
                    alt="Soho Güvenlik" 
                />
            </Link>
        </div>

        {/* Mobile Menu Button */}
        <div className="flex lg:hidden">
            <button
                type="button"
                className={`-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 ${finalTextColor}`}
                onClick={() => setMobileMenuOpen(true)}
            >
                <span className="sr-only">Menüyü aç</span>
                <Bars3Icon className="h-8 w-8" aria-hidden="true" />
            </button>
        </div>

        {/* Desktop Menu */}
        <div className="hidden lg:flex lg:gap-x-2 items-center">
            {currentNavigation.map((item) => {
                // Determine if this item should support dropdown (Services special case)
                // If the user adds 'Hizmetler' dynamically, title might refer to it. Or Url.
                const itemTitle = (item.title || item.name || '').toLowerCase();
                const itemUrl = item.url || item.href || '';
                const hasDropdown = (item.isDropdown === true) || (itemUrl === '/services' || itemTitle.includes('hizmet'));

                if (hasDropdown) {
                    return (
                        <div className="group relative px-3 py-2" key={item.id || item.name}>
                            <Link 
                                to={item.url || item.href}
                                className={`flex items-center gap-x-1 text-sm font-bold uppercase tracking-wide transition-colors ${finalTextColor} hover:text-brand-primary`}
                                target={item.new_tab ? '_blank' : undefined}
                            >
                                {item.title || item.name}
                                <ChevronDownIcon className={`h-3 w-3 transition-transform duration-300 ${finalTextColor} group-hover:rotate-180 group-hover:text-brand-primary`} aria-hidden="true" />
                            </Link>

                            {/* Dropdown Panel - Modern Glass */}
                            <div className="absolute top-full -left-4 pt-4 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out z-50">
                                <div className="w-72 bg-white/95 backdrop-blur-xl shadow-2xl rounded-2xl border border-white/20 overflow-hidden ring-1 ring-black/5">
                                    <div className="p-2">
                                        {services.map((service) => (
                                            <Link 
                                                key={service.id} 
                                                to={`/services/${service.slug}`} 
                                                className="block px-4 py-3 text-sm font-medium text-gray-600 rounded-xl hover:bg-brand-light hover:text-brand-primary transition-colors"
                                            >
                                                {service.title}
                                            </Link>
                                        ))}
                                         <div className="mt-2 pt-2 border-t border-gray-100">
                                            <Link to="/services" className="block px-4 py-2 text-xs font-bold text-center text-brand-primary uppercase hover:text-brand-dark transition-colors">
                                                Tüm Hizmetler
                                            </Link>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )
                }
                
                return (
                    <Link 
                        key={item.id || item.name} 
                        to={item.url || item.href} 
                        className={`px-3 py-2 text-sm font-bold uppercase tracking-wide transition-colors ${finalTextColor} hover:text-brand-primary`}
                        target={item.new_tab ? '_blank' : undefined}
                    >
                    {item.title || item.name}
                    </Link>
                )
            })}
        </div>

        {/* CTA Button */}
        <div className="hidden lg:flex lg:flex-1 lg:justify-end lg:items-center lg:gap-3">
            <Link
              to="/colorvu"
              className={`text-sm font-semibold px-5 py-2 rounded-full border-2 transition-all duration-300 hover:bg-brand-accent hover:text-white hover:border-brand-accent ${
                isHome && !scrolled
                  ? 'border-white/40 text-white'
                  : 'border-brand-accent text-brand-accent'
              }`}
            >
              ColorVu 3.0
            </Link>
            
            <Link 
                to="/contact" 
                className={`relative overflow-hidden group rounded-full px-8 py-2.5 transition-all duration-300 ${
                    isHome && !scrolled 
                    ? 'bg-white/20 backdrop-blur-sm text-white hover:bg-white hover:text-brand-primary ring-1 ring-white/50' 
                    : 'bg-brand-primary text-white hover:bg-brand-glow hover:shadow-glow'
                }`}
            >
                <span className="relative z-10 text-sm font-bold uppercase tracking-wider">Teklif Al</span>
            </Link>
        </div>
      </div>

      {/* Mobile Menu Overlay */}
      <Dialog as="div" className="lg:hidden" open={mobileMenuOpen} onClose={setMobileMenuOpen}>
        <div className="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm" />
        <Dialog.Panel className="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm shadow-2xl ring-1 ring-black/10">
          <div className="flex items-center justify-between mb-8">
             <Link to="/" className="-m-1.5 p-1.5" onClick={() => setMobileMenuOpen(false)}>
                <img className="h-10 w-auto" src="/logo.png" alt="Soho" />
             </Link>
            <button
              type="button"
              className="-m-2.5 rounded-md p-2.5 text-gray-700 hover:text-brand-primary transition-colors"
              onClick={() => setMobileMenuOpen(false)}
            >
              <span className="sr-only">Menüyü kapat</span>
              <XMarkIcon className="h-8 w-8" aria-hidden="true" />
            </button>
          </div>
          <div className="mt-6 flow-root">
            <div className="-my-6 divide-y divide-gray-100">
              <div className="space-y-2 py-6">
                {currentNavigation.map((item) => (
                  <Link
                    key={item.id || item.name}
                    to={item.url || item.href}
                    className="-mx-3 block rounded-xl px-3 py-3 text-base font-bold leading-7 text-gray-900 hover:bg-brand-light hover:text-brand-primary transition-colors uppercase"
                    onClick={() => setMobileMenuOpen(false)}
                  >
                    {item.title || item.name}
                  </Link>
                ))}
                 {/* Mobile Services List */}
                 <div className="pl-4 mt-2 border-l-2 border-brand-primary/20">
                     <p className="px-3 py-2 text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">HİZMETLER</p>
                     {services.map(s => (
                         <Link key={s.id} to={`/services/${s.slug}`} className="block px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-brand-primary" onClick={() => setMobileMenuOpen(false)}>
                             {s.title}
                         </Link>
                     ))}
                </div>
              </div>
              <div className="py-6 space-y-2">
                  <Link
                    to="/colorvu"
                    onClick={() => setMobileMenuOpen(false)}
                    className="flex w-full items-center justify-center rounded-full border-2 border-brand-accent px-3 py-2.5 text-sm font-semibold text-brand-accent hover:bg-brand-accent hover:text-white transition-all"
                  >
                    ColorVu 3.0
                  </Link>
                  
                  <Link
                    to="/contact"
                    className="flex w-full items-center justify-center rounded-full bg-brand-primary px-3 py-3 text-sm font-bold text-white shadow-lg hover:bg-brand-dark transition-colors uppercase"
                     onClick={() => setMobileMenuOpen(false)}
                  >
                    Hemen Teklif Al
                  </Link>
              </div>
            </div>
          </div>
        </Dialog.Panel>
      </Dialog>
    </header>
  );
}
