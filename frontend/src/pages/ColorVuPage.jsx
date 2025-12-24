import { useEffect, useState } from 'react'
import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'

import api from '../lib/axios'
import { getImageUrl } from '../lib/helpers'


export default function ColorVuPage() {
  const [products, setProducts] = useState([])
  const [loading, setLoading] = useState(true)
  const [activeTab, setActiveTab] = useState('bullet')

  useEffect(() => {
    // Scroll to top on mount
    window.scrollTo(0, 0)
    
    setLoading(true)
    api.get('/public/products?category=colorvu')
      .then(res => {
        setProducts(res.data)
      })
      .catch(err => console.error(err))
      .finally(() => setLoading(false))
  }, [])

  // Group products by sub_category
  const groupedProducts = products.reduce((acc, product) => {
    const subCat = product.sub_category || 'other'
    if (!acc[subCat]) acc[subCat] = []
    acc[subCat].push(product)
    return acc
  }, {})

  const tabs = [
    { id: 'bullet', name: 'Bullet (Mermi)' },
    { id: 'turret', name: 'Turret (Taret)' },
    { id: 'dome', name: 'Dome (Kubbe)' },
    { id: 'varifocal', name: 'Varifokal (Zoom)' },
  ]

  const currentProducts = groupedProducts[activeTab] || []

  return (
    <div className="bg-white">
      {/* Hero Section */}
      <div className="relative bg-gray-900 py-24 sm:py-32 isolate overflow-hidden">
        <div className="absolute inset-0 -z-10 h-full w-full object-cover opacity-20 bg-[url('https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center" />
        <div className="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40" />
        
        <div className="mx-auto max-w-7xl px-6 lg:px-8 text-center relative z-10">
          <motion.h1 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-4xl font-black tracking-tight text-white sm:text-6xl uppercase"
          >
            ColorVu 3.0 Teknolojisi
          </motion.h1>
          <motion.p 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.1 }}
            className="mt-6 text-lg leading-8 text-gray-300 max-w-2xl mx-auto"
          >
            Zifiri karanlıkta bile renkli ve net görüntüler. Projenize en uygun profesyonel çözümü seçin.
          </motion.p>
        </div>
      </div>

      <div className="mx-auto max-w-7xl px-6 lg:px-8 py-16">
        {/* Tabs */}
        <div className="flex justify-center border-b border-gray-200 mb-12">
            <nav className="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto" aria-label="Tabs">
                {tabs.map((tab) => (
                    <button
                        key={tab.id}
                        onClick={() => setActiveTab(tab.id)}
                        className={`
                            whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide transition-colors
                            ${activeTab === tab.id
                                ? 'border-brand-primary text-brand-primary'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'}
                        `}
                    >
                        {tab.name}
                    </button>
                ))}
            </nav>
        </div>

        {/* Content */}
        {loading ? (
            <div className="flex justify-center p-24">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-primary"></div>
            </div>
        ) : (
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {currentProducts.length > 0 ? (
                    currentProducts.map((product, index) => (
                        <motion.div 
                            key={product.id}
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ delay: index * 0.05 }}
                            className="group relative flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-xl hover:border-brand-primary/50 transition-all duration-300"
                        >
                            <div className="aspect-[4/3] bg-gray-100 overflow-hidden relative">
                                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-10 flex items-end p-6">
                                    <span className="text-white text-xs font-bold uppercase tracking-wider">Detaylı İncele</span>
                                </div>
                                <img 
                                    src={getImageUrl(product.image) || 'https://via.placeholder.com/400x300?text=ColorVu'}
                                    onError={(e) => { e.target.onerror = null; e.target.src = 'https://via.placeholder.com/400x300?text=ColorVu' }}
                                    alt={product.name}
                                    className="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div className="flex flex-1 flex-col p-6">
                                <h3 className="text-xl font-bold text-gray-900 group-hover:text-brand-primary transition-colors">
                                    {product.name}
                                </h3>
                                <p className="mt-2 text-sm text-gray-500 line-clamp-2">
                                    {product.description}
                                </p>
                                
                                {product.features && (
                                    <div className="mt-6 space-y-3 border-t border-gray-100 pt-6">
                                        {Object.entries(product.features).slice(0, 4).map(([key, value]) => (
                                            <div key={key} className="flex justify-between text-sm">
                                                <span className="text-gray-500 font-medium">{key}</span>
                                                <span className="text-gray-900 font-bold text-right">{value}</span>
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </div>
                            <div className="p-6 bg-gray-50 border-t border-gray-100">
                                <Link 
                                    to={`/colorvu/${product.slug}`} 
                                    className="block w-full rounded-xl bg-brand-primary px-4 py-3 text-center text-sm font-bold text-white shadow hover:bg-brand-dark transition-colors uppercase tracking-wider"
                                >
                                    İNCELE
                                </Link>
                            </div>
                        </motion.div>
                    ))
                ) : (
                    <div className="col-span-full text-center py-24">
                        <div className="text-gray-300 mb-4">
                            <svg className="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 className="mt-2 text-sm font-semibold text-gray-900">Ürün Bulunamadı</h3>
                        <p className="mt-1 text-sm text-gray-500">Bu kategoride henüz ürün girişi yapılmamış.</p>
                    </div>
                )}
            </div>
        )}
      </div>
    </div>
  )
}
