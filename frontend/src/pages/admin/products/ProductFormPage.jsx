import { useState, useEffect, useRef } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';

import { PhotoIcon, ArrowLeftIcon, PlusIcon, TrashIcon, CloudArrowUpIcon, XMarkIcon } from '@heroicons/react/24/outline';
import api from '../../../lib/axios';
import { getImageUrl } from '../../../lib/helpers';
import Swal from 'sweetalert2';

export default function ProductFormPage() {
  const navigate = useNavigate();
  const { id } = useParams();
  const isEditing = !!id;
  const fileInputRef = useRef(null);

  const [formData, setFormData] = useState({
    name: '',
    description: '',
    sub_category: 'bullet',
    image: '',
    features: {},
  });
  
  const [featuresList, setFeaturesList] = useState([{ key: '', value: '' }]);
  const [isLoading, setIsLoading] = useState(false);
  const [isUploading, setIsUploading] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (isEditing) {
      fetchProduct();
    }
  }, [id]);

  const fetchProduct = async () => {
    try {
      setIsLoading(true);
      const response = await api.get(`/admin/products/${id}`);
      const product = response.data;
      
      const featuresArray = product.features 
        ? Object.entries(product.features).map(([key, value]) => ({ key, value }))
        : [{ key: '', value: '' }];

      setFormData({
        name: product.name,
        description: product.description,
        sub_category: product.sub_category,
        image: product.image,
        features: product.features,
      });
      setFeaturesList(featuresArray);
    } catch (err) {
      setError('Ürün bilgileri alınamadı.');
      console.error(err);
    } finally {
      setIsLoading(false);
    }
  };

  const handleFeatureChange = (index, field, value) => {
    const newFeatures = [...featuresList];
    newFeatures[index][field] = value;
    setFeaturesList(newFeatures);
  };

  const addFeature = () => {
    setFeaturesList([...featuresList, { key: '', value: '' }]);
  };

  const removeFeature = (index) => {
    const newFeatures = featuresList.filter((_, i) => i !== index);
    setFeaturesList(newFeatures);
  };

  const handleFileSelect = async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    // Simple validation
    if (!file.type.startsWith('image/')) {
        Swal.fire({
            icon: 'warning',
            title: 'Hatalı Dosya',
            text: 'Lütfen sadece resim dosyası seçiniz.',
            confirmButtonColor: '#4f46e5'
        });
        return;
    }
    if (file.size > 2 * 1024 * 1024) { // 2MB
        Swal.fire({
            icon: 'warning',
            title: 'Dosya Çok Büyük',
            text: 'Dosya boyutu 2MB den küçük olmalıdır.',
            confirmButtonColor: '#4f46e5'
        });
        return;
    }

    const uploadData = new FormData();
    uploadData.append('image', file);

    try {
        setIsUploading(true);
        const response = await api.post('/admin/upload', uploadData, {
            headers: { 'Content-Type': 'multipart/form-data' },
        });
        setFormData({ ...formData, image: response.data.url });
    } catch (err) {
        console.error('Upload failed', err);
        Swal.fire({
            icon: 'error',
            title: 'Yükleme Hatası',
            text: 'Görsel yüklenirken bir hata oluştu.',
            confirmButtonColor: '#4f46e5'
        });
    } finally {
        setIsUploading(false);
         // Reset input so same file can be selected again if needed
         if(fileInputRef.current) fileInputRef.current.value = '';
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError(null);

    const featuresObject = featuresList.reduce((acc, curr) => {
      if (curr.key.trim() !== '') {
        acc[curr.key] = curr.value;
      }
      return acc;
    }, {});

    const payload = {
      ...formData,
      features: featuresObject,
    };

    try {
      if (isEditing) {
        await api.put(`/admin/products/${id}`, payload);
      } else {
        await api.post('/admin/products', payload);
      }
      navigate('/admin/products');
    } catch (err) {
      setError('Kaydetme işlemi başarısız oldu.');
      console.error(err);
    } finally {
      setIsLoading(false);
    }
  };

  if (isLoading && isEditing && !formData.name) {
    return (
        <div className="flex justify-center items-center h-64">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
        </div>
    );
  }

  return (
    <div className="max-w-7xl mx-auto py-6">
      <div className="flex items-center justify-between mb-8">
        <div className="flex items-center gap-4">
            <button 
                onClick={() => navigate('/admin/products')}
                className="p-2 rounded-full hover:bg-gray-100 transition-colors"
            >
                <ArrowLeftIcon className="h-5 w-5 text-gray-500" />
            </button>
            <div>
                <h1 className="text-2xl font-bold text-gray-900 leading-tight">
                    {isEditing ? 'Ürün Düzenle' : 'Yeni Ürün Oluştur'}
                </h1>
                <p className="text-sm text-gray-500 mt-1">
                    {isEditing ? `#${id} numaralı ürünü düzenliyorsunuz` : 'Kataloğa yeni bir ColorVu kamera ekleyin'}
                </p>
            </div>
        </div>
        <div className="flex gap-3">
             <button
                type="button"
                onClick={() => navigate('/admin/products')}
                className="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-shadow"
            >
                İptal
            </button>
            <button
                onClick={handleSubmit}
                disabled={isLoading || isUploading}
                className="px-6 py-2 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-all disabled:opacity-50"
            >
                {isLoading ? 'Kaydediliyor...' : 'Değişiklikleri Kaydet'}
            </button>
        </div>
      </div>
      
      {error && (
        <div className="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 flex items-center justify-between">
          <span>{error}</span>
          <button onClick={() => setError(null)} className="text-red-500 hover:text-red-700 font-bold">&times;</button>
        </div>
      )}

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {/* Left Column: Main Info & Features */}
        <div className="lg:col-span-2 space-y-8">
            
            {/* Basic Info Card */}
            <div className="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 className="text-base font-semibold leading-7 text-gray-900 mb-4">Temel Bilgiler</h2>
                <div className="space-y-6">
                    <div>
                        <label htmlFor="name" className="block text-sm font-medium leading-6 text-gray-900">
                            Ürün Adı / Model Kodu
                        </label>
                        <div className="mt-2">
                            <input
                                type="text"
                                id="name"
                                value={formData.name}
                                onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                                className="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="Örn: 4MP ColorVu Taret Kamera"
                            />
                        </div>
                    </div>

                    <div>
                        <label htmlFor="description" className="block text-sm font-medium leading-6 text-gray-900">
                            Ürün Açıklaması
                        </label>
                        <div className="mt-2">
                            <textarea
                                id="description"
                                rows={4}
                                value={formData.description}
                                onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                                className="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="Ürünün öne çıkan özelliklerini ve kullanım alanlarını yazın..."
                            />
                        </div>
                    </div>
                </div>
            </div>

            {/* Features Card */}
            <div className="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                 <div className="flex items-center justify-between mb-4">
                    <h2 className="text-base font-semibold leading-7 text-gray-900">Teknik Özellikler</h2>
                    <button
                        type="button"
                        onClick={addFeature}
                        className="text-sm font-semibold text-indigo-600 hover:text-indigo-500 flex items-center gap-1"
                    >
                        <PlusIcon className="h-4 w-4" />
                        Yeni Ekle
                    </button>
                </div>
                
                <div className="space-y-3">
                    {featuresList.map((feature, index) => (
                        <div key={index} className="flex gap-3 items-start group">
                            <div className="flex-1">
                                <input
                                    type="text"
                                    placeholder="Özellik (örn: Lens)"
                                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50/50"
                                    value={feature.key}
                                    onChange={(e) => handleFeatureChange(index, 'key', e.target.value)}
                                />
                            </div>
                            <div className="flex-[2]">
                                <input
                                    type="text"
                                    placeholder="Değer (örn: 2.8mm Sabit)"
                                    className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    value={feature.value}
                                    onChange={(e) => handleFeatureChange(index, 'value', e.target.value)}
                                />
                            </div>
                            <button
                                type="button"
                                onClick={() => removeFeature(index)}
                                className="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors opacity-0 group-hover:opacity-100"
                                title="Sil"
                            >
                                <TrashIcon className="h-4 w-4" />
                            </button>
                        </div>
                    ))}

                    {featuresList.length === 0 && (
                        <div className="text-center py-6 border-2 border-dashed border-gray-200 rounded-lg text-gray-500 text-sm">
                            Henüz teknik özellik eklenmemiş.
                        </div>
                    )}
                </div>
            </div>
        </div>

        {/* Right Column: Media & Meta */}
        <div className="space-y-8">
            {/* Category Card */}
             <div className="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 className="text-base font-semibold leading-7 text-gray-900 mb-4">Kategori</h2>
                <div>
                     <label htmlFor="sub_category" className="block text-sm font-medium leading-6 text-gray-900 mb-2">
                        Kamera Tipi
                    </label>
                    <select
                        id="sub_category"
                        value={formData.sub_category}
                        onChange={(e) => setFormData({ ...formData, sub_category: e.target.value })}
                        className="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                        <option value="bullet">Bullet (Mermi)</option>
                        <option value="turret">Turret (Taret)</option>
                        <option value="dome">Dome (Kubbe)</option>
                        <option value="varifocal">Varifokal (Zoom)</option>
                    </select>
                    <p className="mt-2 text-xs text-gray-500">
                        Bu seçim ürünün hangi sekmede görüneceğini belirler.
                    </p>
                </div>
            </div>

            {/* Media Card */}
            <div className="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl p-6">
                <h2 className="text-base font-semibold leading-7 text-gray-900 mb-4">Ürün Görseli</h2>
                
                <div className="mb-4">
                     <div className="relative aspect-[4/3] w-full bg-gray-50 rounded-lg overflow-hidden border-2 border-dashed border-gray-300 group hover:border-indigo-500 transition-colors">
                        {formData.image ? (
                             <>
                                <img 
                                    src={getImageUrl(formData.image)} 
                                    alt="Önizleme" 
                                    className="w-full h-full object-cover object-center"
                                />
                                <div className="absolute top-2 right-2">
                                     <button 
                                        type="button"
                                        onClick={() => setFormData({...formData, image: ''})}
                                        className="p-1.5 bg-white rounded-full shadow-md text-gray-500 hover:text-red-500"
                                     >
                                         <TrashIcon className="h-4 w-4" />
                                     </button>
                                </div>
                             </>
                        ) : (
                            <div 
                                className="absolute inset-0 flex flex-col items-center justify-center cursor-pointer"
                                onClick={() => fileInputRef.current?.click()}
                            >
                                {isUploading ? (
                                     <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mb-2"></div>
                                ) : (
                                    <>
                                        <CloudArrowUpIcon className="h-10 w-10 text-gray-400 mb-2 group-hover:text-indigo-500 transition-colors" />
                                        <span className="text-sm font-medium text-gray-600 group-hover:text-indigo-600">Görsel Seç</span>
                                        <span className="text-xs text-gray-400 mt-1">PNG, JPG, WEBP (Max 2MB)</span>
                                    </>
                                )}
                            </div>
                        )}
                        <input 
                            type="file" 
                            ref={fileInputRef} 
                            className="hidden" 
                            accept="image/*"
                            onChange={handleFileSelect}
                        />
                    </div>
                </div>

                <div>
                    <label htmlFor="image" className="block text-sm font-medium leading-6 text-gray-900">
                        Veya Görsel URL'si
                    </label>
                    <div className="mt-2 flex gap-2">
                        <input
                            type="text"
                            id="image"
                            value={formData.image}
                            onChange={(e) => setFormData({ ...formData, image: e.target.value })}
                            className="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="https://..."
                        />
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  );
}
