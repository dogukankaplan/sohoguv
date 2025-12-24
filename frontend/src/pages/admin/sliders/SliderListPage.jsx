import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../../../lib/axios';
import { PlusIcon, PencilSquareIcon, TrashIcon, PhotoIcon } from '@heroicons/react/24/outline';
import Swal from 'sweetalert2';

export default function SliderListPage() {
  const [sliders, setSliders] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    fetchSliders();
  }, []);

  const fetchSliders = async () => {
    try {
      const response = await api.get('/admin/sliders');
      setSliders(response.data);
    } catch (error) {
      console.error('Failed to fetch sliders', error);
      Swal.fire({
        icon: 'error',
        title: 'Hata',
        text: 'Slider listesi yüklenemedi.',
      });
    } finally {
      setIsLoading(false);
    }
  };

  const handleDelete = async (id) => {
    const result = await Swal.fire({
      title: 'Emin misiniz?',
      text: "Bu slider'ı silmek istediğinize emin misiniz?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Evet, sil!',
      cancelButtonText: 'İptal'
    });

    if (!result.isConfirmed) return;

    try {
      await api.delete(`/admin/sliders/${id}`);
      setSliders(sliders.filter(slider => slider.id !== id));
      Swal.fire(
        'Silindi!',
        'Slider başarıyla silindi.',
        'success'
      );
    } catch (error) {
      console.error('Failed to delete slider', error);
      Swal.fire({
        icon: 'error',
        title: 'Hata',
        text: 'Silme işlemi başarısız oldu.',
      });
    }
  };

  const toggleActive = async (slider) => {
    try {
      const formData = new FormData();
      formData.append('title', slider.title || '');
      formData.append('subtitle', slider.subtitle || '');
      formData.append('button_text', slider.button_text || '');
      formData.append('button_link', slider.button_link || '');
      formData.append('order', slider.order || '0');
      formData.append('is_active', slider.is_active ? '0' : '1');
      formData.append('_method', 'PUT');

      await api.post(`/admin/sliders/${slider.id}`, formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });

      fetchSliders();

      Swal.fire({
        icon: 'success',
        title: 'Başarılı',
        text: `Slider ${slider.is_active ? 'pasif' : 'aktif'} hale getirildi.`,
        timer: 2000,
        showConfirmButton: false
      });
    } catch (error) {
      console.error('Failed to toggle active status', error);
      Swal.fire({
        icon: 'error',
        title: 'Hata',
        text: 'Durum değiştirilemedi.',
      });
    }
  };

  if (isLoading) {
    return (
      <div className="flex justify-center items-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-600"></div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="sm:flex sm:items-center sm:justify-between">
        <div>
          <h1 className="text-2xl font-bold text-gray-900">Slider Yönetimi</h1>
          <p className="mt-2 text-sm text-gray-600">
            Ana sayfa slider alanını buradan yönetebilirsiniz. Önerilen görsel boyutu: 1920x800px
          </p>
        </div>
        <div className="mt-4 sm:mt-0">
          <Link
            to="/admin/sliders/new"
            className="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white text-sm font-semibold rounded-lg shadow-md hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 hover:scale-105"
          >
            <PlusIcon className="h-5 w-5 mr-2" />
            Yeni Slider Ekle
          </Link>
        </div>
      </div>

      {/* Slider Cards */}
      {sliders.length === 0 ? (
        <div className="bg-white rounded-lg shadow-sm p-12 text-center">
          <PhotoIcon className="w-16 h-16 mx-auto text-gray-400 mb-4" />
          <h3 className="text-lg font-medium text-gray-900 mb-2">Henüz slider yok</h3>
          <p className="text-gray-600 mb-6">İlk slider'ınızı oluşturarak başlayın.</p>
          <Link
            to="/admin/sliders/new"
            className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors"
          >
            <PlusIcon className="h-5 w-5 mr-2" />
            İlk Slider'ı Ekle
          </Link>
        </div>
      ) : (
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {sliders.map((slider) => (
            <div 
              key={slider.id} 
              className="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-200"
            >
              {/* Image Preview */}
              <div className="relative h-48 bg-gray-100">
                {slider.media?.[0]?.original_url ? (
                  <img 
                    src={slider.media[0].original_url} 
                    alt={slider.title || 'Slider'} 
                    className="w-full h-full object-cover"
                  />
                ) : (
                  <div className="w-full h-full flex items-center justify-center">
                    <PhotoIcon className="w-16 h-16 text-gray-300" />
                  </div>
                )}
                {/* Status Badge */}
                <div className="absolute top-3 left-3">
                  <button
                    onClick={() => toggleActive(slider)}
                    className={`px-3 py-1 rounded-full text-xs font-semibold transition-all ${
                      slider.is_active
                        ? 'bg-green-100 text-green-800 hover:bg-green-200'
                        : 'bg-gray-100 text-gray-800 hover:bg-gray-200'
                    }`}
                  >
                    {slider.is_active ? '✓ Aktif' : '✗ Pasif'}
                  </button>
                </div>
                {/* Order Badge */}
                <div className="absolute top-3 right-3">
                  <span className="px-3 py-1 bg-black/50 backdrop-blur-sm text-white rounded-full text-xs font-semibold">
                    Sıra: {slider.order}
                  </span>
                </div>
              </div>

              {/* Content */}
              <div className="p-5">
                <h3 className="text-lg font-bold text-gray-900 mb-2 truncate">
                  {slider.title || '(Başlıksız)'}
                </h3>
                {slider.subtitle && (
                  <p className="text-sm text-gray-600 line-clamp-2 mb-3">
                    {slider.subtitle}
                  </p>
                )}
                {slider.button_text && (
                  <div className="flex items-center text-xs text-gray-500 mb-4">
                    <span className="px-2 py-1 bg-gray-100 rounded">
                      Buton: {slider.button_text}
                    </span>
                  </div>
                )}

                {/* Actions */}
                <div className="flex gap-2">
                  <Link
                    to={`/admin/sliders/${slider.id}`}
                    className="flex-1 flex items-center justify-center px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-100 transition-colors"
                  >
                    <PencilSquareIcon className="h-4 w-4 mr-2" />
                    Düzenle
                  </Link>
                  <button
                    onClick={() => handleDelete(slider.id)}
                    className="flex items-center justify-center px-4 py-2 bg-red-50 text-red-700 text-sm font-medium rounded-lg hover:bg-red-100 transition-colors"
                  >
                    <TrashIcon className="h-4 w-4 mr-2" />
                    Sil
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}

      {/* Info Box */}
      {sliders.length > 0 && (
        <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <div className="flex">
            <div className="flex-shrink-0">
              <svg className="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fillRule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clipRule="evenodd" />
              </svg>
            </div>
            <div className="ml-3">
              <h3 className="text-sm font-medium text-blue-800">İpucu</h3>
              <div className="mt-2 text-sm text-blue-700">
                <ul className="list-disc pl-5 space-y-1">
                  <li>Slider'lar "Sıra" değerine göre küçükten büyüğe sıralanır</li>
                  <li>Sadece "Aktif" slider'lar sitede görünür</li>
                  <li>En iyi görüntü için 1920x800px boyutunda görseller kullanın</li>
                  <li>3-5 slider kullanmanızı öneriyoruz</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
