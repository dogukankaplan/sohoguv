import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../../../lib/axios';
import Swal from 'sweetalert2';

export default function TestimonialListPage() {
  const [testimonials, setTestimonials] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    fetchTestimonials();
  }, []);

  const fetchTestimonials = async () => {
    try {
      const response = await api.get('/admin/testimonials');
      setTestimonials(response.data);
    } catch (error) {
      console.error('Failed to fetch testimonials', error);
    } finally {
      setIsLoading(false);
    }
  };

  const handleDelete = async (id) => {
    const result = await Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu yorumu silmek istediğinize emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Evet, sil!',
        cancelButtonText: 'İptal'
    });

    if (!result.isConfirmed) return;
    
    try {
      await api.delete(`/admin/testimonials/${id}`);
      fetchTestimonials();
      Swal.fire(
        'Silindi!',
        'Yorum başarıyla silindi.',
        'success'
      )
    } catch (error) {
      console.error('Failed to delete testimonial', error);
      Swal.fire({
          icon: 'error',
          title: 'Hata',
          text: 'Silme işlemi başarısız oldu.',
      });
    }
  };

  if (isLoading) return <div className="p-8">Yükleniyor...</div>;

  return (
    <div className="px-4 sm:px-6 lg:px-8">
      <div className="sm:flex sm:items-center">
        <div className="sm:flex-auto">
          <h1 className="text-2xl font-semibold text-gray-900">Müşteri Yorumları</h1>
          <p className="mt-2 text-sm text-gray-700">
            Ana sayfada gösterilecek müşteri yorumlarını yönetin.
          </p>
        </div>
        <div className="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
          <Link
            to="/admin/testimonials/new"
            className="block rounded-md bg-brand-primary px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-dark"
          >
            Yeni Yorum Ekle
          </Link>
        </div>
      </div>
      <div className="mt-8 flow-root">
        <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table className="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">İsim</th>
                  <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Şirket</th>
                  <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Pozisyon</th>
                  <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Puan</th>
                  <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sıra</th>
                  <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Durum</th>
                  <th className="relative py-3.5 pl-3 pr-4 sm:pr-0">
                    <span className="sr-only">İşlemler</span>
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-200 bg-white">
                {testimonials.map((testimonial) => (
                  <tr key={testimonial.id}>
                    <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                      {testimonial.name}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{testimonial.company || '-'}</td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{testimonial.position || '-'}</td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      {'⭐'.repeat(testimonial.rating)}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{testimonial.order}</td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <span className={`inline-flex rounded-full px-2 text-xs font-semibold ${testimonial.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}`}>
                        {testimonial.is_active ? 'Aktif' : 'Pasif'}
                      </span>
                    </td>
                    <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <Link to={`/admin/testimonials/${testimonial.id}`} className="text-brand-primary hover:text-brand-dark mr-4">
                        Düzenle
                      </Link>
                      <button onClick={() => handleDelete(testimonial.id)} className="text-red-600 hover:text-red-900">
                        Sil
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
}
