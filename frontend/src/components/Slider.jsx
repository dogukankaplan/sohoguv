import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, Navigation, Pagination, Parallax, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';
import 'swiper/css/parallax';
import axios from '../lib/axios';
import { Link } from 'react-router-dom';
import { ChevronRightIcon } from '@heroicons/react/24/outline';

const Slider = () => {
    const [sliders, setSliders] = useState([]);
    const [loading, setLoading] = useState(true);
    const [activeIndex, setActiveIndex] = useState(0);

    useEffect(() => {
        const fetchSliders = async () => {
            try {
                const { data } = await axios.get('/public/sliders');
                setSliders(Array.isArray(data) ? data : []);
            } catch (error) {
                console.error('Slider fetch error', error);
                setSliders([]);
            } finally {
                setLoading(false);
            }
        };
        fetchSliders();
    }, []);

    if (loading) {
        return (
            <div className="w-full h-[600px] bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 animate-pulse flex items-center justify-center">
                <div className="text-white/50 text-xl">Yükleniyor...</div>
            </div>
        );
    }

    if (sliders.length === 0) {
        return (
            <div className="relative w-full h-[600px] bg-gradient-to-br from-brand-dark via-gray-900 to-black overflow-hidden">
                {/* Animated Background Shapes */}
                <div className="absolute inset-0">
                    <div className="absolute top-20 left-10 w-72 h-72 bg-brand-primary/20 rounded-full blur-3xl animate-pulse"></div>
                    <div className="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse" style={{ animationDelay: '1s' }}></div>
                </div>
                
                <div className="relative h-full flex items-center justify-center text-center px-4">
                    <div className="max-w-4xl">
                        <motion.h1
                            initial={{ opacity: 0, y: 30 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8 }}
                            className="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight"
                        >
                            SOHO Güvenlik Sistemleri
                        </motion.h1>
                        <motion.p
                            initial={{ opacity: 0, y: 30 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.2 }}
                            className="text-xl md:text-2xl text-white/90 mb-8"
                        >
                            İzmir'de Profesyonel Güvenlik Çözümleri
                        </motion.p>
                        <motion.div
                            initial={{ opacity: 0, y: 30 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8, delay: 0.4 }}
                        >
                            <Link 
                                to="/iletisim"
                                className="inline-flex items-center px-8 py-4 bg-gradient-to-r from-brand-primary to-blue-500 text-white text-lg font-bold rounded-full hover:shadow-2xl hover:scale-105 transition-all duration-300"
                            >
                                İletişime Geçin
                                <ChevronRightIcon className="w-5 h-5 ml-2" />
                            </Link>
                        </motion.div>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="relative w-full h-[500px] md:h-[650px] lg:h-[750px] overflow-hidden bg-gray-900">
            <Swiper
                modules={[Autoplay, Navigation, Pagination, Parallax, EffectFade]}
                effect="fade"
                parallax={true}
                spaceBetween={0}
                slidesPerView={1}
                navigation={{
                    nextEl: '.custom-next',
                    prevEl: '.custom-prev',
                }}
                pagination={{ 
                    clickable: true,
                    el: '.custom-pagination',
                    renderBullet: (index, className) => {
                        return `<span class="${className} custom-bullet"></span>`;
                    },
                }}
                autoplay={{ 
                    delay: 6000,
                    disableOnInteraction: false,
                }}
                loop={sliders.length > 1}
                speed={1200}
                onSlideChange={(swiper) => setActiveIndex(swiper.realIndex)}
                className="w-full h-full"
            >
                {sliders.map((slide, index) => (
                    <SwiperSlide key={slide.id}>
                        <div className="relative w-full h-full">
                            {/* Background Image with Parallax */}
                            <div 
                                className="absolute inset-0 w-full h-full"
                                data-swiper-parallax="-20%"
                            >
                                <div className="relative w-full h-full overflow-hidden">
                                    <motion.div
                                        initial={{ scale: 1.2 }}
                                        animate={{ scale: 1 }}
                                        transition={{ duration: 10, ease: "easeOut" }}
                                        className="w-full h-full"
                                    >
                                        <img 
                                            src={slide.media?.[0]?.original_url || slide.image_url || '/logo.png'}
                                            alt={slide.title || 'Slider'}
                                            className="w-full h-full object-cover"
                                        />
                                    </motion.div>
                                </div>
                            </div>

                            {/* Gradient Overlays - Asymmetric Design */}
                            <div className="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>
                            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                            {/* Animated Geometric Shapes */}
                            <div className="absolute inset-0 overflow-hidden pointer-events-none">
                                <motion.div
                                    initial={{ x: -100, opacity: 0 }}
                                    animate={{ x: 0, opacity: 0.1 }}
                                    transition={{ duration: 1.5, delay: 0.5 }}
                                    className="absolute -left-20 top-1/4 w-96 h-96 border-4 border-brand-primary rounded-full"
                                ></motion.div>
                                <motion.div
                                    initial={{ x: 100, opacity: 0 }}
                                    animate={{ x: 0, opacity: 0.1 }}
                                    transition={{ duration: 1.5, delay: 0.7 }}
                                    className="absolute -right-32 bottom-1/4 w-[500px] h-[500px] border-4 border-blue-400 rounded-full"
                                ></motion.div>
                            </div>

                            {/* Content Container */}
                            <div className="absolute inset-0 flex items-center">
                                <div className="container mx-auto px-4 md:px-8 lg:px-12 z-20">
                                    <div className="max-w-3xl">
                                        {/* Title with Parallax */}
                                        {slide.title && (
                                            <motion.div
                                                initial={{ opacity: 0, x: -50 }}
                                                animate={{ opacity: 1, x: 0 }}
                                                transition={{ duration: 0.8, delay: 0.3 }}
                                                data-swiper-parallax="-300"
                                            >
                                                <h1 className="text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-black text-white mb-6 leading-none">
                                                    {slide.title}
                                                    <div className="h-2 w-24 bg-gradient-to-r from-brand-primary to-blue-500 mt-4 rounded-full"></div>
                                                </h1>
                                            </motion.div>
                                        )}
                                        
                                        {/* Subtitle with Parallax */}
                                        {slide.subtitle && (
                                            <motion.div
                                                initial={{ opacity: 0, x: -50 }}
                                                animate={{ opacity: 1, x: 0 }}
                                                transition={{ duration: 0.8, delay: 0.5 }}
                                                data-swiper-parallax="-200"
                                            >
                                                <p className="text-lg md:text-xl lg:text-2xl text-white/95 mb-8 leading-relaxed max-w-2xl font-light">
                                                    {slide.subtitle}
                                                </p>
                                            </motion.div>
                                        )}

                                        {/* Button with Parallax */}
                                        {slide.button_text && slide.button_link && (
                                            <motion.div
                                                initial={{ opacity: 0, x: -50 }}
                                                animate={{ opacity: 1, x: 0 }}
                                                transition={{ duration: 0.8, delay: 0.7 }}
                                                data-swiper-parallax="-100"
                                                className="flex flex-wrap gap-4"
                                            >
                                                <Link 
                                                    to={slide.button_link}
                                                    className="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-brand-primary via-brand-primary to-blue-500 text-white text-lg font-bold rounded-full hover:shadow-2xl hover:shadow-brand-primary/50 transition-all duration-300 hover:scale-105 relative overflow-hidden"
                                                >
                                                    <span className="relative z-10 flex items-center">
                                                        {slide.button_text}
                                                        <ChevronRightIcon className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" />
                                                    </span>
                                                    <div className="absolute inset-0 bg-gradient-to-r from-blue-500 to-brand-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                </Link>
                                            </motion.div>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* Slide Number Indicator */}
                            <div className="absolute top-8 right-8 z-30">
                                <div className="flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
                                    <span className="text-white text-sm font-bold">
                                        {String(index + 1).padStart(2, '0')}
                                    </span>
                                    <div className="w-px h-4 bg-white/30"></div>
                                    <span className="text-white/60 text-sm">
                                        {String(sliders.length).padStart(2, '0')}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </SwiperSlide>
                ))}
            </Swiper>

            {/* Custom Navigation Arrows */}
            {sliders.length > 1 && (
                <>
                    <button className="custom-prev group absolute left-6 md:left-8 top-1/2 -translate-y-1/2 z-40 w-14 h-14 md:w-16 md:h-16 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:scale-110">
                        <svg className="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2.5} d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button className="custom-next group absolute right-6 md:right-8 top-1/2 -translate-y-1/2 z-40 w-14 h-14 md:w-16 md:h-16 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:scale-110">
                        <svg className="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2.5} d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </>
            )}

            {/* Custom Pagination */}
            <div className="custom-pagination absolute bottom-8 left-0 right-0 z-30 flex justify-center gap-3"></div>

            {/* Custom Styles */}
            <style jsx>{`
                .custom-bullet {
                    width: 12px;
                    height: 12px;
                    background: rgba(255, 255, 255, 0.4);
                    border-radius: 50%;
                    transition: all 0.3s;
                    cursor: pointer;
                }
                .custom-bullet:hover {
                    background: rgba(255, 255, 255, 0.7);
                    transform: scale(1.2);
                }
                .custom-bullet.swiper-pagination-bullet-active {
                    background: linear-gradient(135deg, #0BCCB4, #3B82F6);
                    width: 40px;
                    border-radius: 6px;
                }
            `}</style>
        </div>
    );
};

export default Slider;
