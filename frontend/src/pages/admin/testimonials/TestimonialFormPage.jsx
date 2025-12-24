import { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import { useNavigate, useParams } from 'react-router-dom';
import api from '../../../lib/axios';
import Swal from 'sweetalert2';

export default function TestimonialFormPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const { register, handleSubmit, setValue, formState: { errors } } = useForm();
  const [isLoading, setIsLoading] = useState(false);
  const isEdit = !!id;

  useEffect(() => {
    if (isEdit) {
      fetchTestimonial();
    }
  }, [id]);

  const fetchTestimonial = async () => {
    try {
      const response = await api.get(`/admin/testimonials/${id}`);
      const testimonial = response.data;
      setValue('name', testimonial.name);
      setValue('position', testimonial.position);
      setValue('company', testimonial.company);
      setValue('content', testimonial.content);
      setValue('rating', testimonial.rating);
      setValue('order', testimonial.order);
      setValue('is_active', testimonial.is_active);
    } catch (error) {
      console.error('Failed to fetch testimonial', error);
    }
  };

  const onSubmit = async (data) => {
    setIsLoading(true);
    try {
      if (isEdit) {
        await api.put(`/admin/testimonials/${id}`, data);
      } else {
        await api.post('/admin/testimonials', data);
      }
      navigate('/admin/testimonials');
    } catch (error) {
      console.error('Failed to save testimonial', error);
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
    <div className="px-4 sm:px-6 lg:px-8">
      <div className="md:flex md:items-center md:justify-between">
        <div className="min-w-0 flex-1">
          <h2 className="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            {isEdit ? 'Yorum Düzenle' : 'Yeni Yorum Ekle'}
          </h2>
        </div>
      </div>

      <form onSubmit={handleSubmit(onSubmit)} className="mt-8 space-y-8 bg-white shadow sm:rounded-lg sm:p-6">
        <div className="grid grid-cols-6 gap-6">
          <div className="col-span-6 sm:col-span-3">
            <label className="block text-sm font-medium text-gray-700">
              İsim *
            </label>
            <input
              type="text"
              {...register('name', { required: 'İsim gerekli' })}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm"
            />
            {errors.name && <p className="mt-1 text-sm text-red-600">{errors.name.message}</p>}
          </div>

          <div className="col-span-6 sm:col-span-3">
            <label className="block text-sm font-medium text-gray-700">
              Şirket
            </label>
            <input
              type="text"
              {...register('company')}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm"
            />
          </div>

          <div className="col-span-6 sm:col-span-3">
            <label className="block text-sm font-medium text-gray-700">
              Pozisyon
            </label>
            <input
              type="text"
              {...register('position')}
              placeholder="örn: Genel Müdür"
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm"
            />
          </div>

          <div className="col-span-6 sm:col-span-2">
            <label className="block text-sm font-medium text-gray-700">
              Puan (1-5) *
            </label>
            <select
              {...register('rating', { required: true, valueAsNumber: true })}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm"
            >
              <option value="5">⭐⭐⭐⭐⭐ (5)</option>
              <option value="4">⭐⭐⭐⭐ (4)</option>
              <option value="3">⭐⭐⭐ (3)</option>
              <option value="2">⭐⭐ (2)</option>
              <option value="1">⭐ (1)</option>
            </select>
          </div>

          <div className="col-span-6 sm:col-span-1">
            <label className="block text-sm font-medium text-gray-700">
              Sıra
            </label>
            <input
              type="number"
              {...register('order', { valueAsNumber: true })}
              defaultValue={0}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm"
            />
          </div>

          <div className="col-span-6">
            <label className="block text-sm font-medium text-gray-700">
              Yorum *
            </label>
            <textarea
              rows={4}
              {...register('content', { required: 'Yorum gerekli' })}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm"
            />
            {errors.content && <p className="mt-1 text-sm text-red-600">{errors.content.message}</p>}
          </div>

          <div className="col-span-6">
            <div className="flex items-start">
              <div className="flex h-5 items-center">
                <input
                  type="checkbox"
                  {...register('is_active')}
                  defaultChecked={true}
                  className="h-4 w-4 rounded border-gray-300 text-brand-primary focus:ring-brand-primary"
                />
              </div>
              <div className="ml-3 text-sm">
                <label className="font-medium text-gray-700">
                  Aktif
                </label>
                <p className="text-gray-500">Ana sayfada görünsün mü?</p>
              </div>
            </div>
          </div>
        </div>

        <div className="flex justify-end gap-3">
          <button
            type="button"
            onClick={() => navigate('/admin/testimonials')}
            className="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50"
          >
            İptal
          </button>
          <button
            type="submit"
            disabled={isLoading}
            className="rounded-md bg-brand-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-dark disabled:opacity-50"
          >
            {isLoading ? 'Kaydediliyor...' : 'Kaydet'}
          </button>
        </div>
      </form>
    </div>
  );
}
