import React, { useEffect, useState } from 'react';
import axios from '../../lib/axios';
import { Link } from 'react-router-dom';
import { 
  Squares2X2Icon, 
  UsersIcon, 
  DocumentTextIcon, 
  ShoppingBagIcon,
  ChatBubbleLeftRightIcon
} from '@heroicons/react/24/outline';

const DashboardPage = () => {
  const [stats, setStats] = useState({
    services: 0,
    blogs: 0,
    products: 0,
    messages: 0,
    offers: 0
  });

  useEffect(() => {
    // Simulate fetching stats or fetch real stats if API endpoint exists
    // For now we'll just try to fetch counts or use placeholders
    // Ideally the backend should have a /dashboard endpoint with stats
    const fetchStats = async () => {
        try {
            const { data } = await axios.get('/admin/dashboard');
            setStats(data);
        } catch (error) {
            console.error('Dashboard stats error:', error);
        }
    };
    fetchStats();
  }, []);

  const statsCards = [
    { title: 'Hizmetler', value: stats.service_count || 0, icon: Squares2X2Icon, color: 'bg-blue-500', link: '/admin/services' },
    { title: 'Ürünler', value: stats.product_count || 0, icon: ShoppingBagIcon, color: 'bg-green-500', link: '/admin/products' },
    { title: 'Blog Yazıları', value: stats.blog_count || 0, icon: DocumentTextIcon, color: 'bg-purple-500', link: '/admin/blogs' },
    { title: 'Gelen Mesajlar', value: stats.contact_count || 0, icon: ChatBubbleLeftRightIcon, color: 'bg-orange-500', link: '/admin/contacts' },
  ];

  return (
    <div className="space-y-6">
      <h1 className="text-2xl font-bold text-gray-800">Yönetim Paneli</h1>
      
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {statsCards.map((stat, index) => (
          <Link to={stat.link} key={index} className="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4 hover:shadow-md transition-shadow cursor-pointer">
            <div className={`p-4 rounded-lg text-white ${stat.color}`}>
              <stat.icon className="w-8 h-8" />
            </div>
            <div>
              <p className="text-gray-500 text-sm font-medium">{stat.title}</p>
              <h3 className="text-2xl font-bold text-gray-800">{stat.value}</h3>
            </div>
          </Link>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
        <div className="bg-white p-6 rounded-xl shadow-sm">
            <h2 className="text-lg font-bold mb-4">Hızlı İşlemler</h2>
            <div className="grid grid-cols-2 gap-4">
                <Link to="/admin/products/new" className="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center text-sm font-medium text-gray-700">
                    + Yeni Ürün Ekle
                </Link>
                <Link to="/admin/blogs/new" className="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center text-sm font-medium text-gray-700">
                    + Yeni Blog Yazısı
                </Link>
                <Link to="/admin/services/new" className="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center text-sm font-medium text-gray-700">
                    + Yeni Hizmet Ekle
                </Link>
                <Link to="/teklif" className="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center text-sm font-medium text-gray-700">
                    Teklif Hazırla
                </Link>
            </div>
        </div>
        
        <div className="bg-white p-6 rounded-xl shadow-sm">
            <h2 className="text-lg font-bold mb-4">Son Mesajlar</h2>
            <p className="text-gray-500 text-sm italic">Henüz yeni mesaj yok.</p>
        </div>
      </div>
    </div>
  );
};

export default DashboardPage;
