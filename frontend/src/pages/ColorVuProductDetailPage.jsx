import { useEffect, useState } from 'react'
import { useParams, Link } from 'react-router-dom'
import { motion } from 'framer-motion'
import { CheckCircleIcon } from '@heroicons/react/24/solid'
import api from '../lib/axios'
import { getImageUrl } from '../lib/helpers'

export default function ColorVuProductDetailPage() {
  const { slug } = useParams()
  const [product, setProduct] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    window.scrollTo(0, 0)
    setLoading(true)
    api.get(`/public/products/${slug}`) // Note: Need to implement this endpoint!
      .then(res => setProduct(res.data))
      .catch(err => console.error(err))
      .finally(() => setLoading(false))
  }, [slug])

  if (loading) {
     return (
        <div className="flex justify-center items-center min-h-screen bg-gray-50">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-primary"></div>
        </div>
    )
  }

  if (!product) {
      return (
         <div className="min-h-screen flex items-center justify-center bg-gray-50">
            <div className="text-center">
                <h2 className="text-3xl font-bold text-gray-900">Ürün Bulunamadı</h2>
                <Link to="/colorvu" className="mt-4 text-brand-primary hover:underline">Geri Dön</Link>
            </div>
         </div>
      )
  }

  return (
    <div className="bg-white min-h-screen pt-24 pb-12">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div className="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
                
                {/* Image Gallery */}
                <motion.div 
                    initial={{ opacity: 0, x: -20 }}
                    animate={{ opacity: 1, x: 0 }}
                    className="flex flex-col-reverse"
                >
                    <div className="aspect-[4/3] w-full overflow-hidden rounded-2xl bg-gray-100 mt-6 lg:mt-0 border border-gray-200">
                        <img 
                            src={getImageUrl(product.image) || 'https://via.placeholder.com/800x600?text=Product'} 
                            alt={product.name} 
                            onError={(e) => { e.target.onerror = null; e.target.src = 'https://via.placeholder.com/800x600?text=Product' }}
                            className="h-full w-full object-cover object-center transform hover:scale-105 transition-transform duration-500" 
                        />
                    </div>
                </motion.div>

                {/* Product Info */}
                <motion.div 
                    initial={{ opacity: 0, x: 20 }}
                    animate={{ opacity: 1, x: 0 }}
                    className="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0"
                >
                    <div className="mb-4">
                        <span className="inline-flex items-center rounded-full bg-brand-light px-3 py-1 text-sm font-bold uppercase text-brand-primary">
                            {product.sub_category} Series
                        </span>
                    </div>

                    <h1 className="text-3xl font-black tracking-tight text-gray-900 uppercase sm:text-4xl">{product.name}</h1>
                    
                    <div className="mt-6">
                        <h3 className="sr-only">Açıklama</h3>
                        <div className="space-y-6 text-base text-gray-700 leading-relaxed">
                            <p>{product.description}</p>
                        </div>
                    </div>

                    <div className="mt-8 border-t border-gray-200 pt-8">
                        <h3 className="text-sm font-bold text-gray-900 uppercase tracking-wide">Teknik Özellikler</h3>
                        <div className="mt-4 space-y-4">
                            {product.features && Object.entries(product.features).map(([key, value]) => (
                                <div key={key} className="flex items-center justify-between border-b border-gray-100 pb-2 last:border-0">
                                    <span className="text-gray-500 font-medium">{key}</span>
                                    <span className="text-gray-900 font-bold">{value}</span>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className="mt-10 flex gap-4">
                         <Link 
                            to="/contact" 
                            className="flex max-w-xs flex-1 items-center justify-center rounded-xl border border-transparent bg-brand-primary px-8 py-4 text-base font-bold text-white hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-2 focus:ring-offset-gray-50 uppercase tracking-wider transition-all shadow-lg hover:shadow-xl"
                        >
                            Teklif İste
                        </Link>
                        <Link 
                            to="/colorvu" 
                            className="flex max-w-xs flex-1 items-center justify-center rounded-xl border-2 border-gray-200 bg-white px-8 py-4 text-base font-bold text-gray-900 hover:bg-gray-50 focus:outline-none uppercase tracking-wider transition-all"
                        >
                            Geri Dön
                        </Link>
                    </div>
                    
                    <div className="mt-8 flex items-center gap-2 text-sm text-gray-500">
                        <CheckCircleIcon className="h-5 w-5 text-green-500" />
                        <span>2 Yıl Garanti</span>
                        <span className="mx-2">•</span>
                        <CheckCircleIcon className="h-5 w-5 text-green-500" />
                        <span>Ücretsiz Keşif</span>
                        <span className="mx-2">•</span>
                        <CheckCircleIcon className="h-5 w-5 text-green-500" />
                        <span>7/24 Destek</span>
                    </div>
                </motion.div>
            </div>
        </div>
    </div>
  )
}
