import { useState } from 'react';
import { useForm } from 'react-hook-form';
import api from '../lib/axios';
import Swal from 'sweetalert2';
import { EnvelopeIcon, PhoneIcon, MapPinIcon } from '@heroicons/react/24/outline';
import PageHero from '../components/PageHero';
import Seo from '../components/Seo';
import { useSettings } from '../context/SettingsContext';

export default function ContactPage() {
  const { register, handleSubmit, reset, formState: { errors } } = useForm();
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [successMessage, setSuccessMessage] = useState('');
  const { settings } = useSettings();

  const onSubmit = async (data) => {
    setIsSubmitting(true);
    try {
      await api.post('/public/contact', data);
      setSuccessMessage('Mesajınız başarıyla iletildi. En kısa sürede sizinle iletişime geçeceğiz.');
      reset();
      Swal.fire({
          icon: 'success',
          title: 'Başarılı!',
          text: 'Mesajınız başarıyla iletildi.',
          confirmButtonColor: '#00ced1'
      });
    } catch (error) {
      console.error('Failed to send message', error);
      Swal.fire({
          icon: 'error',
          title: 'Hata',
          text: 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyin.',
          confirmButtonColor: '#00ced1'
      });
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <>
      <Seo 
        title="İletişim | SOHO Güvenlik İzmir" 
        description="Ücretsiz keşif ve teklif için bize ulaşın. İzmir ve Ege bölgesi güvenlik sistemleri iletişim."
        keywords="iletişim güvenlik, soho iletişim, izmir güvenlik telefonu, ücretsiz keşif"
      />
      
      <PageHero 
        title="Bize Ulaşın" 
        subtitle="Projeleriniz için profesyonel çözümler sunmak üzere buradayız."
        bgImage="https://images.unsplash.com/photo-1423666639041-f142fcb96319?q=80&w=2070&auto=format&fit=crop"
      />

      <div className="relative isolate bg-white">
        <div className="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
          <div className="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
            <div className="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
              <h2 className="text-3xl font-black tracking-tight text-brand-dark uppercase">İletişim Bilgileri</h2>
              <p className="mt-6 text-lg leading-8 text-gray-600">
                Aşağıdaki iletişim kanallarından bize ulaşabilir veya form doldurarak ücretsiz keşif talebinde bulunabilirsiniz.
              </p>
              <dl className="mt-10 space-y-4 text-base leading-7 text-gray-600">
                <div className="flex gap-x-4">
                  <dt className="flex-none">
                    <span className="sr-only">Adres</span>
                    <MapPinIcon className="h-7 w-6 text-brand-primary" aria-hidden="true" />
                  </dt>
                  <dd>{settings.contact_address || '123 Güvenlik Sokak, İş Merkezi No: 88, İzmir, Türkiye'}</dd>
                </div>
                <div className="flex gap-x-4">
                  <dt className="flex-none">
                    <span className="sr-only">Telefon</span>
                    <PhoneIcon className="h-7 w-6 text-brand-primary" aria-hidden="true" />
                  </dt>
                  <dd><a className="hover:text-brand-dark font-bold" href={`tel:${settings.contact_phone || '+905551234567'}`}>{settings.contact_phone || '+90 (555) 123 45 67'}</a></dd>
                </div>
                <div className="flex gap-x-4">
                  <dt className="flex-none">
                    <span className="sr-only">Email</span>
                    <EnvelopeIcon className="h-7 w-6 text-brand-primary" aria-hidden="true" />
                  </dt>
                  <dd><a className="hover:text-brand-dark font-bold" href={`mailto:${settings.contact_email || 'info@sohoguvenlik.com'}`}>{settings.contact_email || 'info@sohoguvenlik.com'}</a></dd>
                </div>
              </dl>
              
               <div className="mt-10 h-64 w-full rounded-xl overflow-hidden shadow-lg border border-gray-200">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d195.2412160443324!2d27.136170852084607!3d38.46780583816811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbd9bfebdb9b3d%3A0xbe688e2037c1b6f7!2sSoho%20G%C3%BCvenlik%20Bilgisayar%20ve%20Elektronik%20Pazarlama%20Ltd%20Sti!5e0!3m2!1str!2str!4v1765460562816!5m2!1str!2str" 
                        width="100%" 
                        height="100%" 
                        style={{ border: 0 }} 
                        allowFullScreen="" 
                        loading="lazy" 
                        referrerPolicy="no-referrer-when-downgrade"
                        title="Soho Güvenlik Konum"
                    ></iframe>
               </div>
            </div>
          </div>
          <form onSubmit={handleSubmit(onSubmit)} className="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48 bg-gray-50 border-l border-gray-100">
            <div className="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
              <div className="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div className="sm:col-span-2">
                  <label htmlFor="name" className="block text-sm font-bold leading-6 text-brand-dark uppercase tracking-wide">Ad Soyad / Firma</label>
                  <div className="mt-2.5">
                    <input type="text" {...register('name', { required: true })} className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" />
                    {errors.name && <span className="text-red-500 text-xs font-bold">Zorunlu alan</span>}
                  </div>
                </div>
                <div className="sm:col-span-2">
                  <label htmlFor="email" className="block text-sm font-bold leading-6 text-brand-dark uppercase tracking-wide">Email</label>
                  <div className="mt-2.5">
                    <input type="email" {...register('email', { required: true, pattern: /^\S+@\S+$/i })} className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" />
                     {errors.email && <span className="text-red-500 text-xs font-bold">Geçerli bir email giriniz</span>}
                  </div>
                </div>
                <div className="sm:col-span-2">
                  <label htmlFor="phone" className="block text-sm font-bold leading-6 text-brand-dark uppercase tracking-wide">Telefon</label>
                  <div className="mt-2.5">
                    <input type="tel" {...register('phone')} className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" />
                  </div>
                </div>
                <div className="sm:col-span-2">
                  <label htmlFor="message" className="block text-sm font-bold leading-6 text-brand-dark uppercase tracking-wide">Mesajınız</label>
                  <div className="mt-2.5">
                    <textarea rows={4} {...register('message', { required: true })} className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" />
                     {errors.message && <span className="text-red-500 text-xs font-bold">Zorunlu alan</span>}
                  </div>
                </div>
              </div>
              <div className="mt-8 flex justify-end">
                <button
                  type="submit"
                  disabled={isSubmitting}
                  className="rounded-md bg-brand-primary px-6 py-3 text-center text-sm font-bold text-white shadow-lg hover:bg-brand-dark transition-colors uppercase tracking-widest disabled:opacity-50"
                >
                  {isSubmitting ? 'Gönderiliyor...' : 'MESAJI GÖNDER'}
                </button>
              </div>
              {successMessage && (
                  <div className="mt-4 p-4 rounded-md bg-green-50 text-green-700 border border-green-200 shadow-sm">
                      {successMessage}
                  </div>
              )}
            </div>
          </form>
        </div>
      </div>
    </>
  );
}
