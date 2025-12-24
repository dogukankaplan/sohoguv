import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../lib/axios';
import PageHero from '../components/PageHero';
import Seo from '../components/Seo';
import LoadingScreen from '../components/LoadingScreen';

export default function BlogPage() {
  const [blogs, setBlogs] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchBlogs = async () => {
      try {
        const response = await api.get('/public/blogs');
        setBlogs(response.data.data); // Paginated response
      } catch (error) {
        console.error('Failed to fetch blogs', error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchBlogs();
  }, []);

  if (isLoading) return <div className="h-screen flex items-center justify-center bg-white"><div className="w-16 h-1 bg-brand-primary animate-pulse"></div></div>;

  return (
    <>
      <Seo 
        title="Blog & Haberler | SOHO Güvenlik" 
        description="Güvenlik sistemleri, kamera teknolojileri ve akıllı bina otomasyonları hakkında güncel bilgiler, makaleler ve haberler."
        keywords="güvenlik blog, kamera sistemleri makale, soho haberler, güvenlik teknolojileri"
      />
      
      <PageHero 
        title="Blog & Haberler" 
        subtitle="Güvenlik teknolojileri dünyasındaki son gelişmeler ve uzman görüşleri."
        bgImage="https://images.unsplash.com/photo-1504384308090-c54be3855033?q=80&w=2070&auto=format&fit=crop"
      />

      <div className="bg-white py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            {blogs.map((post) => (
              <article key={post.id} className="flex flex-col items-start justify-between group">
                <div className="relative w-full overflow-hidden rounded-2xl">
                  <img
                    src={post.media?.[0]?.original_url || 'https://via.placeholder.com/800x600?text=No+Image'}
                    alt={post.title}
                    className="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition-transform duration-500 group-hover:scale-110"
                  />
                  <div className="absolute inset-0 ring-1 ring-inset ring-brand-dark/10" />
                </div>
                <div className="max-w-xl">
                  <div className="mt-8 flex items-center gap-x-4 text-xs">
                    <time dateTime={post.published_at} className="text-gray-500 bg-gray-100 px-3 py-1 rounded-full font-bold uppercase tracking-wide">
                      {new Date(post.published_at).toLocaleDateString('tr-TR')}
                    </time>
                  </div>
                  <div className="group relative">
                    <h3 className="mt-3 text-lg font-bold leading-6 text-brand-dark group-hover:text-brand-primary transition-colors uppercase">
                      <Link to={`/blog/${post.slug}`}>
                        <span className="absolute inset-0" />
                        {post.title}
                      </Link>
                    </h3>
                    <p className="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{post.excerpt}</p>
                  </div>
                  <div className="relative mt-8 flex items-center gap-x-4">
                     {/* Author info removed for cleaner corporate look, or could be kept if desired */}
                     <span className="text-sm font-semibold text-brand-primary uppercase tracking-widest hover:text-brand-dark transition-colors">
                        Devamını Oku &rarr;
                     </span>
                  </div>
                </div>
              </article>
            ))}
          </div>
        </div>
      </div>
    </>
  );
}
