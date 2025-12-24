import { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import api from '../../../lib/axios';
import Swal from 'sweetalert2';
import { PhotoIcon, ArrowLeftIcon } from '@heroicons/react/24/outline';

export default function SliderFormPage() {
  const { id } = useParams();
  const isEditMode = !!id;
  const navigate = useNavigate();
  const [isLoading, setIsLoading] = useState(false);
  const [currentImage, setCurrentImage] = useState(null);
  const [previewImage, setPreviewImage] = useState(null);
  const { register, handleSubmit, setValue, watch, formState: { errors } } = useForm({
    defaultValues: {
      is_active: true,
      order: 0
    }
  });
  
  const watchedFields = watch();

  useEffect(() => {
    if (isEditMode) {
      fetchSlider();
    }
  }, [id]);

  const fetchSlider = async () => {
    try {
      const response = await api.get(`/admin/sliders/${id}`);
      const data = response.data;
      setValue('title', data.title);
      setValue('subtitle', data.subtitle);
      setValue('button_text', data.button_text);
      setValue('button_link', data.button_link);
      setValue('order', data.order);
      setValue('is_active', data.is_active);
      if (data.media && data.media.length > 0) {
        setCurrentImage(data.media[0].original_url);
        setPreviewImage(data.media[0].original_url);
      }
    } catch (error) {
      console.error('Failed to fetch slider', error);
      Swal.fire({
        icon: 'error',
        title: 'Hata',
        text: 'Slider yüklenirken bir hata oluştu.',
      });
      navigate('/admin/sliders');
    }
  };

  const handleImageChange = (e) => {
    const file = e.target.files?.[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setPreviewImage(reader.result);
      };
      reader.readAsDataURL(file);
    }
  };

  const onSubmit = async (data) => {
    setIsLoading(true);
    const formData = new FormData();
    formData.append('title', data.title || '');
    formData.append('subtitle', data.subtitle || '');
    formData.append('button_text', data.button_text || '');
    formData.append('button_link', data.button_link || '');
    formData.append('order', data.order || '0');
    formData.append('is_active', data.is_active ? '1' : '0');

    if (data.image && data.image[0]) {
      formData.append('image', data.image[0]);
    }
    
    if (isEditMode) {
      formData.append('_method', 'PUT');
    }

    try {
      if (isEditMode) {
        await api.post(`/admin/sliders/${id}`, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        Swal.fire({
          icon: 'success',
          title: 'Başarılı',
          text: 'Slider güncellendi.',
          timer: 2000,
          showConfirmButton: false
        });
      } else {
        await api.post('/admin/sliders', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        Swal.fire({
          icon: 'success',
          title: 'Başarılı',
          text: 'Slider oluşturuldu.',
          timer: 2000,
          showConfirmButton: false
        });
      }
      navigate('/admin/sliders');
    } catch (error) {
      console.error('Failed to save slider', error);
      Swal.fire({
        icon: 'error',
        title: 'Kaydetme Hatası',
        text: error.response?.data?.message || 'Kaydetme işlemi başarısız oldu.',
      });
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="max-w-7xl mx-auto py-6 space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div className="flex items-center gap-4">
          <button
            onClick={() => navigate('/admin/sliders')}
            className="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors"
          >
            <ArrowLeftIcon className="h-5 w-5" />
          </button>
          <div>
            <h1 className="text-2xl font-bold text-gray-900">
              {isEditMode ? 'Slider Düzenle' : 'Yeni Slider Ekle'}
            </h1>
            <p className="text-sm text-gray-600 mt-1">
              Slider görsel ve içeriklerini buradan yönetebilirsiniz.
            </p>
          </div>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Form Column */}
        <div className="space-y-6">
          <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
            {/* Image Upload Card */}
            <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <h3 className="text-lg font-semibold text-gray-900 mb-4">Slider Görseli</h3>
              
              <div className="space-y-4">
                {previewImage && (
                  <div className="relative rounded-lg overflow-hidden bg-gray-100">
                    <img 
                      src={previewImage} 
                      alt="Preview" 
                      className="w-full h-48 object-cover"
                    />
                  </div>
                )}

                <div className="flex items-center justify-center w-full">
                  <label 
                    htmlFor="image-upload" 
                    className="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                  >
                    <div className="flex flex-col items-center justify-center pt-5 pb-6">
                      <PhotoIcon className="w-10 h-10 mb-2 text-gray-400" />
                      <p className="mb-2 text-sm text-gray-500">
                        <span className="font-semibold">Görsel seçin</span> veya sürükleyin
                      </p>
                      <p className="text-xs text-gray-500">PNG, JPG (Önerilen: 1920x800px)</p>
                    </div>
                    <input 
                      id="image-upload" 
                      type="file"
                      accept="image/*"
                      {...register('image', { 
                        required: !isEditMode && !currentImage 
                      })}
                      onChange={(e) => {
                        register('image').onChange(e);
                        handleImageChange(e);
                      }}
                      className="hidden"
                    />
                  </label>
                </div>
                {errors.image && (
                  <p className="text-sm text-red-600">Görsel zorunludur</p>
                )}
              </div>
            </div>

            {/* Content Card */}
            <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <h3 className="text-lg font-semibold text-gray-900 mb-4">İçerik</h3>
              
              <div className="space-y-4">
                <div>
                  <label htmlFor="title" className="block text-sm font-medium text-gray-700 mb-1">
                    Başlık
                  </label>
                  <input
                    type="text"
                    id="title"
                    {...register('title')}
                    placeholder="Örn: Modern Güvenlik Sistemleri"
                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                  />
                </div>

                <div>
                  <label htmlFor="subtitle" className="block text-sm font-medium text-gray-700 mb-1">
                    Alt Başlık / Açıklama
                  </label>
                  <textarea
                    id="subtitle"
                    rows={3}
                    {...register('subtitle')}
                    placeholder="Slider'da gösterilecek açıklama metni..."
                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                  />
                </div>

                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <label htmlFor="button_text" className="block text-sm font-medium text-gray-700 mb-1">
                      Buton Metni
                    </label>
                    <input
                      type="text"
                      id="button_text"
                      {...register('button_text')}
                      placeholder="Örn: Detaylı Bilgi"
                      className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    />
                  </div>

                  <div>
                    <label htmlFor="button_link" className="block text-sm font-medium text-gray-700 mb-1">
                      Buton Linki
                    </label>
                    <input
                      type="text"
                      id="button_link"
                      {...register('button_link')}
                      placeholder="/hizmetlerimiz"
                      className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    />
                  </div>
                </div>
              </div>
            </div>

            {/* Settings Card */}
            <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
              <h3 className="text-lg font-semibold text-gray-900 mb-4">Ayarlar</h3>
              
              <div className="space-y-4">
                <div>
                  <label htmlFor="order" className="block text-sm font-medium text-gray-700 mb-1">
                    Sıralama
                  </label>
                  <input
                    type="number"
                    id="order"
                    {...register('order')}
                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                  />
                  <p className="mt-1 text-xs text-gray-500">Küçük değerli slider'lar önce gösterilir</p>
                </div>

                <div className="flex items-start">
                  <div className="flex items-center h-5">
                    <input
                      id="is_active"
                      type="checkbox"
                      {...register('is_active')}
                      className="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    />
                  </div>
                  <div className="ml-3">
                    <label htmlFor="is_active" className="text-sm font-medium text-gray-700">
                      Aktif
                    </label>
                    <p className="text-xs text-gray-500">İşaretli ise sitede görünür</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Action Buttons */}
            <div className="flex gap-3">
              <button
                type="button"
                onClick={() => navigate('/admin/sliders')}
                className="flex-1 px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors"
              >
                İptal
              </button>
              <button
                type="submit"
                disabled={isLoading}
                className="flex-1 px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-indigo-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
              >
                {isLoading ? 'Kaydediliyor...' : (isEditMode ? 'Güncelle' : 'Oluştur')}
              </button>
            </div>
          </form>
        </div>

        {/* Preview Column */}
        <div className="lg:sticky lg:top-6 h-fit">
          <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Canlı Önizleme</h3>
            
            <div className="relative h-64 rounded-lg overflow-hidden bg-gray-900">
              {previewImage ? (
                <img 
                  src={previewImage} 
                  alt="Preview" 
                  className="w-full h-full object-cover opacity-80"
                />
              ) : (
                <div className="w-full h-full flex items-center justify-center">
                  <PhotoIcon className="w-16 h-16 text-gray-600" />
                </div>
              )}
              
              {/* Overlay */}
              <div className="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
              
              {/* Content Preview */}
              <div className="absolute inset-0 flex items-center p-8">
                <div className="max-w-lg">
                  {watchedFields.title && (
                    <h2 className="text-3xl font-bold text-white mb-3 drop-shadow-lg">
                      {watchedFields.title}
                    </h2>
                  )}
                  {watchedFields.subtitle && (
                    <p className="text-white/90 text-lg mb-4 drop-shadow-lg">
                      {watchedFields.subtitle}
                    </p>
                  )}
                  {watchedFields.button_text && (
                    <div className="inline-flex items-center px-6 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white text-sm font-semibold rounded-full">
                      {watchedFields.button_text}
                    </div>
                  )}
                </div>
              </div>
            </div>

            {/* Info */}
            <div className="mt-4 p-4 bg-blue-50 rounded-lg">
              <p className="text-sm text-blue-800">
                <strong>İpucu:</strong> Soldaki formu doldurdukça burada canlı önizleme görünür.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
