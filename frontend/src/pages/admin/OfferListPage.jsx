import { useState, useEffect } from 'react';
import api from '../../lib/axios';
import { TrashIcon, EyeIcon } from '@heroicons/react/24/outline';
import Swal from 'sweetalert2';

export default function OfferListPage() {
  const [offers, setOffers] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    fetchOffers();
  }, []);

  const fetchOffers = async () => {
    try {
      const response = await api.get('/admin/offers');
      setOffers(response.data.data);
    } catch (error) {
      console.error('Failed to fetch offers', error);
    } finally {
      setIsLoading(false);
    }
  };

  const handleDelete = async (id) => {
    const result = await Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu teklifi silmek istediğinize emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Evet, sil!',
        cancelButtonText: 'İptal'
    });

    if (!result.isConfirmed) return;

    try {
      await api.delete(`/admin/offers/${id}`);
      setOffers(offers.filter(item => item.id !== id));
      Swal.fire(
        'Silindi!',
        'Teklif başarıyla silindi.',
        'success'
      )
    } catch (error) {
      console.error('Failed to delete offer', error);
      Swal.fire({
          icon: 'error',
          title: 'Hata',
          text: 'Silme işlemi başarısız oldu.',
      });
    }
  };

  const handleMarkRead = async (id) => {
      await api.get(`/admin/offers/${id}`);
      setOffers(offers.map(c => c.id === id ? {...c, is_read: 1} : c));
  }

  if (isLoading) return <div>Yükleniyor...</div>;

  return (
    <div>
      <div className="sm:flex sm:items-center">
        <div className="sm:flex-auto">
          <h1 className="text-base font-semibold leading-6 text-gray-900">Teklif Talepleri</h1>
          <p className="mt-2 text-sm text-gray-700">
            Web sitesi teklif formundan gelen talepler.
          </p>
        </div>
      </div>
      <div className="mt-8 flow-root">
        <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
              <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                  <tr>
                    <th scope="col" className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Gönderen</th>
                    <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">İlgili Hizmet</th>
                    <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Telefon</th>
                    <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tarih</th>
                    <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6"><span className="sr-only">İşlemler</span></th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-gray-200 bg-white">
                  {offers.map((item) => (
                    <tr key={item.id} className={!item.is_read ? 'bg-blue-50' : ''}>
                      <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                        {item.name} <br/> <span className="text-gray-500 font-normal">{item.email}</span>
                      </td>
                      <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{item.service?.title || '-'}</td>
                      <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{item.phone}</td>
                      <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{new Date(item.created_at).toLocaleDateString()}</td>
                      <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                         <button onClick={() => handleMarkRead(item.id)} className="text-indigo-600 hover:text-indigo-900 mr-4" title="Okundu işaretle/Detay">
                            <EyeIcon className="h-5 w-5 inline-block"/>
                        </button>
                        <button onClick={() => handleDelete(item.id)} className="text-red-600 hover:text-red-900">
                          <TrashIcon className="h-5 w-5 inline-block" />
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
    </div>
  );
}
