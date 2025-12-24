import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import api from '../lib/axios';
import PageHero from '../components/PageHero';
import Seo from '../components/Seo';
import { ArrowLongLeftIcon, CalendarIcon, UserIcon } from '@heroicons/react/24/outline';

export default function BlogDetailPage() {
  const { slug } = useParams();
  const [blog, setBlog] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await api.get(`/public/blogs/${slug}`);
        setBlog(response.data);
      } catch (error) {
        console.error('Failed to fetch blog', error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchBlog();
  }, [slug]);

  if (isLoading) {
    return (
      <div className="flex items-center justify-center min-h-screen">
        <div className="w-16 h-1 bg-brand-primary animate-pulse"></div>
      </div>
    );
  }

  if (!blog) {
    return (
      <div className="flex flex-col items-center justify-center min-h-screen">
        <h1 className="text-2xl font-bold text-gray-900 mb-4">Yazı Bulunamadı</h1>
        <Link to="/blog" className="text-brand-primary hover:text-brand-dark">
          ← Blog'a Dön
        </Link>
      </div>
    );
  }

  const publishDate = new Date(blog.published_at).toLocaleDateString('tr-TR', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });

  return (
    <>
      <Seo
        title={`${blog.title} | SOHO Güvenlik Blog`}
        description={blog.excerpt || blog.content?.substring(0, 155)}
        keywords={`${blog.title}, güvenlik haberleri, blog`}
      />

      {/* BlogPosting Schema.org Structured Data */}
      <script type="application/ld+json">
        {JSON.stringify({
          "@context": "https://schema.org",
          "@type": "BlogPosting",
          "headline": blog.title,
          "description": blog.excerpt,
          "image": blog.media?.[0]?.original_url,
          "datePublished": blog.published_at,
          "dateModified": blog.updated_at,
          "author": {
            "@type": "Person",
            "name": blog.user?.name || "SOHO Güvenlik"
          },
          "publisher": {
            "@type": "Organization",
            "name": "SOHO Güvenlik Sistemleri",
            "logo": {
              "@type": "ImageObject",
              "url": window.location.origin + "/logo.png"
            }
          },
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": window.location.href
          }
        })}
      </script>

      <PageHero
        title={blog.title}
        subtitle="Blog & Haberler"
        bgImage={blog.media?.[0]?.original_url}
      />

      <div className="bg-white py-16 lg:py-24">
        <div className="container mx-auto px-4 lg:px-8">
          <article className="mx-auto max-w-4xl">
            {/* Back Button */}
            <Link 
              to="/blog" 
              className="inline-flex items-center gap-2 text-sm font-semibold text-brand-primary hover:text-brand-dark mb-8 group"
            >
              <ArrowLongLeftIcon className="h-5 w-5 group-hover:-translate-x-1 transition-transform" />
              Tüm Yazılar
            </Link>

            {/* Blog Meta */}
            <div className="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-8">
              <div className="flex items-center gap-2">
                <CalendarIcon className="h-5 w-5 text-brand-primary" />
                <time dateTime={blog.published_at}>{publishDate}</time>
              </div>
              {blog.user && (
                <div className="flex items-center gap-2">
                  <UserIcon className="h-5 w-5 text-brand-primary" />
                  <span>{blog.user.name}</span>
                </div>
              )}
            </div>

            {/* Featured Image */}
            {blog.media?.[0] && (
              <div className="mb-12 rounded-3xl overflow-hidden shadow-2xl">
                <img
                  className="w-full h-96 lg:h-[500px] object-cover"
                  src={blog.media[0].original_url}
                  alt={blog.title}
                />
              </div>
            )}

            {/* Blog Excerpt */}
            {blog.excerpt && (
              <div className="bg-brand-light/30 border-l-4 border-brand-primary p-6 rounded-r-2xl mb-12">
                <p className="text-xl text-gray-700 leading-relaxed font-medium">
                  {blog.excerpt}
                </p>
              </div>
            )}

            {/* Blog Content */}
            <div className="prose prose-lg max-w-none">
              <div className="text-gray-700 leading-relaxed whitespace-pre-line text-lg">
                {blog.content}
              </div>
            </div>

            {/* Share / Tags Section (optional) */}
            <div className="mt-16 pt-8 border-t border-gray-200">
              <div className="flex flex-wrap items-center justify-between gap-4">
                <div className="text-sm text-gray-500">
                  Son güncelleme: {new Date(blog.updated_at).toLocaleDateString('tr-TR')}
                </div>
                <div className="flex gap-3">
                  <span className="text-sm text-gray-500">Paylaş:</span>
                  <button className="text-gray-400 hover:text-brand-primary transition-colors">
                    <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                  </button>
                  <button className="text-gray-400 hover:text-brand-primary transition-colors">
                    <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            {/* CTA */}
            <div className="mt-16 bg-gradient-to-r from-brand-primary to-brand-glow p-8 rounded-3xl text-center text-white">
              <h2 className="text-3xl font-bold mb-4">Güvenlik Çözümlerimizi Keşfedin</h2>
              <p className="text-lg mb-6 opacity-90">
                Profesyonel güvenlik sistemleri hakkında daha fazla bilgi alın.
              </p>
              <Link
                to="/services"
                className="inline-block bg-white text-brand-primary px-8 py-4 rounded-full font-bold hover:bg-brand-dark hover:text-white transition-all shadow-lg"
              >
                Hizmetlerimiz
              </Link>
            </div>
          </article>
        </div>
      </div>
    </>
  );
}
