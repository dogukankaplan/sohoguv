import React, { Suspense, lazy } from 'react';
import { createBrowserRouter } from 'react-router-dom';
import MainLayout from './layouts/MainLayout';
import AdminLayout from './layouts/AdminLayout'; // Check path
import LoginLayout from './layouts/LoginLayout'; // Check path

// Lazy Load Pages
const HomePage = lazy(() => import('./pages/HomePage'));
const CorporatePage = lazy(() => import('./pages/CorporatePage'));
const ServicesPage = lazy(() => import('./pages/ServicesPage'));
const ServiceDetailPage = lazy(() => import('./pages/ServiceDetailPage'));
const ReferencesPage = lazy(() => import('./pages/ReferencesPage'));
const BlogPage = lazy(() => import('./pages/BlogPage'));
const BlogDetailPage = lazy(() => import('./pages/BlogDetailPage'));
const ContactPage = lazy(() => import('./pages/ContactPage'));
const ColorVuPage = lazy(() => import('./pages/ColorVuPage'));
const ColorVuProductDetailPage = lazy(() => import('./pages/ColorVuProductDetailPage'));

// Teklif
const TeklifPage = lazy(() => import('./pages/Teklif/TeklifPage'));

// Admin Pages
const LoginPage = lazy(() => import('./pages/admin/LoginPage'));
const DashboardPage = lazy(() => import('./pages/admin/DashboardPage')); // Hope this exists
const SettingsPage = lazy(() => import('./pages/admin/SettingsPage'));
const ContactListPage = lazy(() => import('./pages/admin/ContactListPage'));
const OfferListPage = lazy(() => import('./pages/admin/OfferListPage'));

// Admin Cruds
const ServiceListPage = lazy(() => import('./pages/admin/services/ServiceListPage'));
const ServiceFormPage = lazy(() => import('./pages/admin/services/ServiceFormPage'));

const BlogListPage = lazy(() => import('./pages/admin/blogs/BlogListPage'));
const BlogFormPage = lazy(() => import('./pages/admin/blogs/BlogFormPage'));

const ReferenceListPage = lazy(() => import('./pages/admin/references/ReferenceListPage'));
const ReferenceFormPage = lazy(() => import('./pages/admin/references/ReferenceFormPage'));

const SliderListPage = lazy(() => import('./pages/admin/sliders/SliderListPage'));
const SliderFormPage = lazy(() => import('./pages/admin/sliders/SliderFormPage'));

const ProductListPage = lazy(() => import('./pages/admin/products/ProductListPage'));
const ProductFormPage = lazy(() => import('./pages/admin/products/ProductFormPage'));

const TestimonialListPage = lazy(() => import('./pages/admin/testimonials/TestimonialListPage'));
const TestimonialFormPage = lazy(() => import('./pages/admin/testimonials/TestimonialFormPage'));

const MenuListPage = lazy(() => import('./pages/admin/menus/MenuListPage'));

// Loading Component
const Loading = () => <div className="flex justify-center items-center h-screen">Yükleniyor...</div>;

const router = createBrowserRouter([
  {
    path: '/',
    element: <MainLayout />,
    children: [
      { index: true, element: <Suspense fallback={<Loading />}><HomePage /></Suspense> },
      { path: 'kurumsal', element: <Suspense fallback={<Loading />}><CorporatePage /></Suspense> },
      { path: 'corporate', element: <Suspense fallback={<Loading />}><CorporatePage /></Suspense> },
      { path: 'hizmetlerimiz', element: <Suspense fallback={<Loading />}><ServicesPage /></Suspense> },
      { path: 'services', element: <Suspense fallback={<Loading />}><ServicesPage /></Suspense> },
      { path: 'hizmetlerimiz/:slug', element: <Suspense fallback={<Loading />}><ServiceDetailPage /></Suspense> },
      { path: 'services/:slug', element: <Suspense fallback={<Loading />}><ServiceDetailPage /></Suspense> },
      { path: 'referanslar', element: <Suspense fallback={<Loading />}><ReferencesPage /></Suspense> },
      { path: 'references', element: <Suspense fallback={<Loading />}><ReferencesPage /></Suspense> },
      { path: 'blog', element: <Suspense fallback={<Loading />}><BlogPage /></Suspense> },
      { path: 'blog/:slug', element: <Suspense fallback={<Loading />}><BlogDetailPage /></Suspense> },
      { path: 'iletisim', element: <Suspense fallback={<Loading />}><ContactPage /></Suspense> },
      { path: 'contact', element: <Suspense fallback={<Loading />}><ContactPage /></Suspense> },
      { path: 'colorvu', element: <Suspense fallback={<Loading />}><ColorVuPage /></Suspense> },
      { path: 'colorvu/:slug', element: <Suspense fallback={<Loading />}><ColorVuProductDetailPage /></Suspense> },
    ]
  },
  {
    path: '/teklif',
    element: <Suspense fallback={<Loading />}><TeklifPage /></Suspense>
  },
  {
    path: '/admin/login',
    element: <LoginLayout><Suspense fallback={<Loading />}><LoginPage /></Suspense></LoginLayout>
  },
  {
    path: '/admin',
    element: <AdminLayout />,
    children: [
      { index: true, element: <Suspense fallback={<Loading />}><DashboardPage /></Suspense> },
      { path: 'dashboard', element: <Suspense fallback={<Loading />}><DashboardPage /></Suspense> },
      
      // Services
      { path: 'services', element: <Suspense fallback={<Loading />}><ServiceListPage /></Suspense> },
      { path: 'services/new', element: <Suspense fallback={<Loading />}><ServiceFormPage /></Suspense> },
      { path: 'services/:id/edit', element: <Suspense fallback={<Loading />}><ServiceFormPage /></Suspense> },
      
      // Blogs
      { path: 'blogs', element: <Suspense fallback={<Loading />}><BlogListPage /></Suspense> },
      { path: 'blogs/new', element: <Suspense fallback={<Loading />}><BlogFormPage /></Suspense> },
      { path: 'blogs/:id/edit', element: <Suspense fallback={<Loading />}><BlogFormPage /></Suspense> },
      
      // References
      { path: 'references', element: <Suspense fallback={<Loading />}><ReferenceListPage /></Suspense> },
      { path: 'references/new', element: <Suspense fallback={<Loading />}><ReferenceFormPage /></Suspense> },
      { path: 'references/:id/edit', element: <Suspense fallback={<Loading />}><ReferenceFormPage /></Suspense> },

      // Sliders
      { path: 'sliders', element: <Suspense fallback={<Loading />}><SliderListPage /></Suspense> },
      { path: 'sliders/new', element: <Suspense fallback={<Loading />}><SliderFormPage /></Suspense> },
      { path: 'sliders/:id/edit', element: <Suspense fallback={<Loading />}><SliderFormPage /></Suspense> },
      
      // Products
      { path: 'products', element: <Suspense fallback={<Loading />}><ProductListPage /></Suspense> },
      { path: 'products/new', element: <Suspense fallback={<Loading />}><ProductFormPage /></Suspense> },
      { path: 'products/:id/edit', element: <Suspense fallback={<Loading />}><ProductFormPage /></Suspense> },

      // Testimonials
      { path: 'testimonials', element: <Suspense fallback={<Loading />}><TestimonialListPage /></Suspense> },
      { path: 'testimonials/new', element: <Suspense fallback={<Loading />}><TestimonialFormPage /></Suspense> },
      { path: 'testimonials/:id/edit', element: <Suspense fallback={<Loading />}><TestimonialFormPage /></Suspense> },

      // Others
      { path: 'menus', element: <Suspense fallback={<Loading />}><MenuListPage /></Suspense> },
      { path: 'contacts', element: <Suspense fallback={<Loading />}><ContactListPage /></Suspense> },
      { path: 'offers', element: <Suspense fallback={<Loading />}><OfferListPage /></Suspense> },
      { path: 'settings', element: <Suspense fallback={<Loading />}><SettingsPage /></Suspense> },
    ]
  }
]);

export default router;
