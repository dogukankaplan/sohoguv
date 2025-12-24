import { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import api from '../../lib/axios';
import Swal from 'sweetalert2';

export default function SettingsPage() {
  const [isLoading, setIsLoading] = useState(true);
  const { register, handleSubmit, setValue } = useForm();

  useEffect(() => {
    fetchSettings();
  }, []);

  const fetchSettings = async () => {
    try {
      const response = await api.get('/admin/settings');
      const settings = response.data;
      Object.keys(settings).forEach(key => {
        setValue(key, settings[key]);
      });
    } catch (error) {
      console.error('Failed to fetch settings', error);
    } finally {
      setIsLoading(false);
    }
  };

  const onSubmit = async (data) => {
    setIsLoading(true);
    try {
      await api.post('/admin/settings', { settings: data });
      Swal.fire({
          icon: 'success',
          title: 'Başarılı',
          text: 'Ayarlar başarıyla güncellendi.',
          timer: 1500,
          showConfirmButton: false
      });
    } catch (error) {
      console.error('Failed to save settings', error);
      Swal.fire({
          icon: 'error',
          title: 'Hata',
          text: 'Ayarlar kaydedilirken bir hata oluştu.',
      });
    } finally {
      setIsLoading(false);
    }
  };

  if (isLoading) return <div className="flex items-center justify-center h-64"><div className="text-gray-600">Yükleniyor...</div></div>;

  return (
    <div className="max-w-6xl mx-auto py-6">
      <div className="md:grid md:grid-cols-3 md:gap-6">
        <div className="md:col-span-1">
          <div className="px-4 sm:px-0">
            <h3 className="text-lg font-semibold leading-6 text-gray-900">Site Ayarları</h3>
            <p className="mt-1 text-sm text-gray-600">
              Site genel ayarlarını, iletişim bilgilerini ve sosyal medya linklerini buradan yönetebilirsiniz.
            </p>
          </div>
        </div>
        <div className="mt-5 md:col-span-2 md:mt-0">
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="shadow sm:overflow-hidden sm:rounded-md">
              <div className="space-y-8 bg-white px-4 py-6 sm:p-6">
                
                {/* GENEL BİLGİLER */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Genel Bilgiler</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6 sm:col-span-4">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Site Adı</label>
                      <input 
                        type="text" 
                        {...register('site_name')} 
                        placeholder="SOHO Güvenlik Sistemleri"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Site Açıklaması</label>
                      <textarea 
                        rows={3} 
                        {...register('site_description')} 
                        placeholder="Site hakkında kısa açıklama"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                  </div>
                </div>

                {/* İLETİŞİM BİLGİLERİ */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">İletişim Bilgileri</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Adres</label>
                      <textarea 
                        rows={2} 
                        {...register('contact_address')} 
                        placeholder="Şirket adresiniz"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Telefon</label>
                      <input 
                        type="text" 
                        {...register('contact_phone')} 
                        placeholder="+90 (555) 123 45 67"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Email</label>
                      <input 
                        type="email" 
                        {...register('contact_email')} 
                        placeholder="info@example.com"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                  </div>
                </div>

                {/* SOSYAL MEDYA */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Sosyal Medya Linkleri</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Facebook</label>
                      <input 
                        type="url" 
                        {...register('social_facebook')} 
                        placeholder="https://facebook.com/..."
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Instagram</label>
                      <input 
                        type="url" 
                        {...register('social_instagram')} 
                        placeholder="https://instagram.com/..."
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                  </div>
                </div>

                {/* SEO */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">SEO Ayarları</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Anahtar Kelimeler</label>
                      <textarea 
                        rows={2} 
                        {...register('seo_keywords')} 
                        placeholder="güvenlik sistemleri, kamera sistemleri, alarm..."
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                      <p className="mt-1 text-xs text-gray-500">Virgül ile ayırarak yazın</p>
                    </div>
                  </div>
                </div>

                {/* ANA SAYFA */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Ana Sayfa Hero</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Hero Başlık</label>
                      <input 
                        type="text" 
                        {...register('home_hero_title')} 
                        placeholder="Ana sayfa büyük başlık"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Hero Alt Başlık</label>
                      <input 
                        type="text" 
                        {...register('home_hero_subtitle')} 
                        placeholder="Ana sayfa alt başlık"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                  </div>
                </div>

                {/* İSTATİSTİKLER */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Ana Sayfa İstatistikleri</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Tamamlanan Proje</label>
                      <input 
                        type="text" 
                        {...register('home_stats_projects')} 
                        placeholder="500+"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Mutlu Müşteri</label>
                      <input 
                        type="text" 
                        {...register('home_stats_clients')} 
                        placeholder="300+"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Yıllık Deneyim</label>
                      <input 
                        type="text" 
                        {...register('home_stats_experience')} 
                        placeholder="15+"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Teknik Destek</label>
                      <input 
                        type="text" 
                        {...register('home_stats_support')} 
                        placeholder="7/24"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                  </div>
                </div>

                {/* ANA SAYFA BAŞLIKLARI */}
                <div>
                  <h4 className="text-base font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Ana Sayfa Bölüm Başlıkları</h4>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">"Neden Biz?" Başlık</label>
                      <input 
                        type="text" 
                        {...register('home_why_title')} 
                        placeholder="Neden SOHO Güvenlik?"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Hizmetler Başlık</label>
                      <input 
                        type="text" 
                        {...register('home_services_title')} 
                        placeholder="Profesyonel Güvenlik Çözümleri"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Referanslar Başlık</label>
                      <input 
                        type="text" 
                        {...register('home_references_title')} 
                        placeholder="Güvenilir Referanslar"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                    <div className="col-span-6">
                      <label className="block text-sm font-medium leading-6 text-gray-900">Blog Başlık</label>
                      <input 
                        type="text" 
                        {...register('home_blog_title')} 
                        placeholder="Son Gelişmeler & Haberler"
                        className="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-primary sm:text-sm sm:leading-6" 
                      />
                    </div>
                  </div>
                </div>

              </div>
              <div className="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button
                  type="submit"
                  disabled={isLoading}
                  className="inline-flex justify-center rounded-md bg-brand-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-dark transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-primary disabled:opacity-50"
                >
                  {isLoading ? 'Kaydediliyor...' : 'Değişiklikleri Kaydet'}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
