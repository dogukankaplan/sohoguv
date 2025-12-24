import { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import api from '../../../lib/axios';
import Swal from 'sweetalert2';

export default function BlogFormPage() {
  const { id } = useParams();
  const isEditMode = !!id;
  const navigate = useNavigate();
  const [isLoading, setIsLoading] = useState(false);
  const [currentImage, setCurrentImage] = useState(null);
  const { register, handleSubmit, setValue, formState: { errors } } = useForm();
  
  useEffect(() => {
    if (isEditMode) {
      fetchBlog();
    }
  }, [id]);

  const fetchBlog = async () => {
    try {
      const response = await api.get(`/admin/blogs/${id}`);
      const blog = response.data;
      setValue('title', blog.title);
      setValue('excerpt', blog.excerpt);
      setValue('content', blog.content);
      setValue('seo_title', blog.seo_title);
      setValue('seo_description', blog.seo_description);
      if (blog.media && blog.media.length > 0) {
          setCurrentImage(blog.media[0].original_url);
      }
    } catch (error) {
      console.error('Failed to fetch blog', error);
      Swal.fire({
          icon: 'error',
          title: 'Hata',
          text: 'Blog yazısı yüklenirken bir hata oluştu.',
      });
      navigate('/admin/blogs');
    }
  };

  const onSubmit = async (data) => {
    setIsLoading(true);
    const formData = new FormData();
    formData.append('title', data.title);
    formData.append('excerpt', data.excerpt || '');
    formData.append('content', data.content);
    formData.append('seo_title', data.seo_title || '');
    formData.append('seo_description', data.seo_description || '');

    if (data.image && data.image[0]) {
        formData.append('image', data.image[0]);
    }
    
    if (isEditMode) {
        formData.append('_method', 'PUT');
    }

    try {
      if (isEditMode) {
        await api.post(`/admin/blogs/${id}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
      } else {
        await api.post('/admin/blogs', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
      }
      navigate('/admin/blogs');
    } catch (error) {
      console.error('Failed to save blog', error);
      Swal.fire({
          icon: 'error',
          title: 'Kaydetme Hatası',
          text: 'Kaydetme işlemi başarısız oldu.',
      });
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="max-w-4xl mx-auto py-6">
      <div className="md:grid md:grid-cols-3 md:gap-6">
        <div className="md:col-span-1">
          <div className="px-4 sm:px-0">
            <h3 className="text-base font-semibold leading-6 text-gray-900">
              {isEditMode ? 'Yazıyı Düzenle' : 'Yeni Yazı Ekle'}
            </h3>
            <p className="mt-1 text-sm text-gray-600">
              Blog içeriğini buradan yönetebilirsiniz.
            </p>
          </div>
        </div>
        <div className="mt-5 md:col-span-2 md:mt-0">
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="shadow sm:overflow-hidden sm:rounded-md">
              <div className="space-y-6 bg-white px-4 py-5 sm:p-6">
                
                <div className="grid grid-cols-6 gap-6">
                  <div className="col-span-6">
                    <label htmlFor="title" className="block text-sm font-medium leading-6 text-gray-900">Başlık</label>
                    <input
                      type="text"
                      id="title"
                      {...register('title', { required: 'Başlık zorunludur' })}
                      className="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2"
                    />
                    {errors.title && <p className="text-red-500 text-xs mt-1">{errors.title.message}</p>}
                  </div>

                  <div className="col-span-6">
                    <label htmlFor="excerpt" className="block text-sm font-medium leading-6 text-gray-900">Kısa Özet</label>
                    <textarea
                      id="excerpt"
                      rows={3}
                      {...register('excerpt')}
                      className="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2"
                    />
                  </div>

                  <div className="col-span-6">
                    <label htmlFor="content" className="block text-sm font-medium leading-6 text-gray-900">İçerik</label>
                    <textarea
                      id="content"
                      rows={12}
                      {...register('content', { required: 'İçerik zorunludur' })}
                      className="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2"
                    />
                    {errors.content && <p className="text-red-500 text-xs mt-1">{errors.content.message}</p>}
                  </div>
                  
                  <div className="col-span-6 sm:col-span-4">
                    <label htmlFor="image" className="block text-sm font-medium leading-6 text-gray-900">Kapak Görseli</label>
                    <div className="mt-2 text-sm text-gray-500">
                         {currentImage && (
                            <div className="mb-4">
                                <p className="mb-2">Mevcut Görsel:</p>
                                <img src={currentImage} alt="Current" className="h-40 w-auto object-cover rounded-lg border border-gray-200" />
                            </div>
                        )}
                        <input
                          type="file"
                          id="image"
                          {...register('image')}
                          className="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        />
                    </div>
                  </div>
                  
                  <div className="col-span-6">
                    <h4 className="text-sm font-bold text-gray-900 mt-4 mb-2 border-b pb-1">SEO Ayarları</h4>
                    <div className="grid grid-cols-6 gap-6">
                        <div className="col-span-6 sm:col-span-4">
                            <label htmlFor="seo_title" className="block text-sm font-medium leading-6 text-gray-900">SEO Başlık</label>
                            <input
                            type="text"
                            id="seo_title"
                            {...register('seo_title')}
                            className="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2"
                            />
                        </div>
                        <div className="col-span-6">
                            <label htmlFor="seo_description" className="block text-sm font-medium leading-6 text-gray-900">SEO Açıklama</label>
                            <textarea
                            id="seo_description"
                            rows={2}
                            {...register('seo_description')}
                            className="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2"
                            />
                        </div>
                    </div>
                  </div>

                </div>
              </div>
              <div className="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button
                  type="button"
                  onClick={() => navigate('/admin/blogs')}
                  className="mr-3 inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                >
                  İptal
                </button>
                <button
                  type="submit"
                  disabled={isLoading}
                  className="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50"
                >
                  {isLoading ? 'Kaydediliyor...' : 'Kaydet'}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
