import { useState, useEffect } from 'react';
import { PlusIcon, PencilIcon, TrashIcon } from '@heroicons/react/24/outline';
import api from '../../../lib/axios';
import Swal from 'sweetalert2';

export default function MenuListPage() {
    const [menus, setMenus] = useState([]);
    const [loading, setLoading] = useState(true);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentMenu, setCurrentMenu] = useState(null);
    const [formData, setFormData] = useState({ title: '', url: '', type: 'header', order: 0, new_tab: false, is_active: true });

    useEffect(() => {
        fetchMenus();
    }, []);

    const fetchMenus = async () => {
        try {
            const response = await api.get('/admin/menu-items');
            setMenus(response.data);
        } catch (error) {
            console.error('Failed to fetch menus', error);
        } finally {
            setLoading(false);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (currentMenu) {
                await api.put(`/admin/menu-items/${currentMenu.id}`, formData);
            } else {
                await api.post('/admin/menu-items', formData);
            }
            setIsModalOpen(false);
            fetchMenus();
            resetForm();
            Swal.fire({
                icon: 'success',
                title: 'Başarılı',
                text: 'İşlem başarıyla tamamlandı.',
                timer: 1500,
                showConfirmButton: false
            });
        } catch (error) {
            console.error('Operation failed', error);
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'İşlem başarısız oldu.',
            });
        }
    };

    const handleDelete = async (id) => {
        const result = await Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu menü öğesini silmek istediğinize emin misiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'İptal'
        });

        if (!result.isConfirmed) return;

        try {
            await api.delete(`/admin/menu-items/${id}`);
            fetchMenus();
            Swal.fire(
                'Silindi!',
                'Menü öğesi silindi.',
                'success'
            )
        } catch (error) {
            console.error('Failed to delete', error);
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'Silme işlemi başarısız oldu.',
            });
        }
    };

    const openEditModal = (menu) => {
        setCurrentMenu(menu);
        setFormData({ ...menu });
        setIsModalOpen(true);
    };

    const resetForm = () => {
        setCurrentMenu(null);
        setFormData({ title: '', url: '', type: 'header', order: 0, new_tab: false, is_active: true });
    };

    if (loading) return <div>Yükleniyor...</div>;

    return (
        <div>
            <div className="sm:flex sm:items-center">
                <div className="sm:flex-auto">
                    <h1 className="text-base font-semibold leading-6 text-gray-900">Menü Yönetimi</h1>
                    <p className="mt-2 text-sm text-gray-700">Navbar ve Footer menülerini buradan yönetebilirsiniz.</p>
                </div>
                <div className="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button
                        onClick={() => { resetForm(); setIsModalOpen(true); }}
                        type="button"
                        className="block rounded-md bg-brand-primary px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-dark transition-colors"
                    >
                        <PlusIcon className="h-4 w-4 inline-block mr-1" /> Yeni Ekle
                    </button>
                </div>
            </div>

            <div className="mt-8 flow-root">
                <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table className="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Başlık</th>
                                    <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">URL</th>
                                    <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Konum</th>
                                    <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sıra</th>
                                    <th className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Durum</th>
                                    <th className="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span className="sr-only">İşlemler</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200">
                                {menus.map((menu) => (
                                    <tr key={menu.id}>
                                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{menu.title}</td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{menu.url}</td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500 uppercase">{menu.type}</td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{menu.order}</td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span className={`inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset ${menu.is_active ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-red-50 text-red-700 ring-red-600/20'}`}>
                                                {menu.is_active ? 'Aktif' : 'Pasif'}
                                            </span>
                                        </td>
                                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                            <button onClick={() => openEditModal(menu)} className="text-indigo-600 hover:text-indigo-900 mr-4"><PencilIcon className="h-4 w-4" /></button>
                                            <button onClick={() => handleDelete(menu.id)} className="text-red-600 hover:text-red-900"><TrashIcon className="h-4 w-4" /></button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {/* Modal */}
            {isModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                    <div className="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
                        <h2 className="text-lg font-bold mb-4">{currentMenu ? 'Menü Düzenle' : 'Yeni Menü Ekle'}</h2>
                        <form onSubmit={handleSubmit} className="space-y-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">Başlık</label>
                                <input type="text" required value={formData.title} onChange={e => setFormData({...formData, title: e.target.value})} className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm border p-2" />
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700">URL</label>
                                <input type="text" required value={formData.url} onChange={e => setFormData({...formData, url: e.target.value})} className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm border p-2" />
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700">Konum</label>
                                <select value={formData.type} onChange={e => setFormData({...formData, type: e.target.value})} className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm border p-2">
                                    <option value="header">Header (Üst Menü)</option>
                                    <option value="footer_main">Footer (Hızlı Erişim)</option>
                                    <option value="footer_other">Footer (Diğer)</option>
                                </select>
                            </div>
                            <div className="flex gap-4">
                                <div className="flex-1">
                                    <label className="block text-sm font-medium text-gray-700">Sıra</label>
                                    <input type="number" required value={formData.order} onChange={e => setFormData({...formData, order: parseInt(e.target.value)})} className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary sm:text-sm border p-2" />
                                </div>
                                <div className="flex items-center pt-6">
                                    <input type="checkbox" checked={formData.new_tab} onChange={e => setFormData({...formData, new_tab: e.target.checked})} className="h-4 w-4 rounded border-gray-300 text-brand-primary focus:ring-brand-primary" />
                                    <label className="ml-2 block text-sm text-gray-900">Yeni Sekme</label>
                                </div>
                                <div className="flex items-center pt-6">
                                    <input type="checkbox" checked={formData.is_active} onChange={e => setFormData({...formData, is_active: e.target.checked})} className="h-4 w-4 rounded border-gray-300 text-brand-primary focus:ring-brand-primary" />
                                    <label className="ml-2 block text-sm text-gray-900">Aktif</label>
                                </div>
                            </div>
                            <div className="flex justify-end gap-2 mt-6">
                                <button type="button" onClick={() => setIsModalOpen(false)} className="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">İptal</button>
                                <button type="submit" className="px-4 py-2 text-sm font-medium text-white bg-brand-primary rounded-md hover:bg-brand-dark">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
}
