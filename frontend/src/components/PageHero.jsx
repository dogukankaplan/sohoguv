import { motion } from 'framer-motion';

export default function PageHero({ title, subtitle, bgImage = "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop" }) {
  return (
    <div className="relative isolate overflow-hidden bg-brand-dark py-24 sm:py-32">
        <div className="absolute inset-0 -z-10">
            <img src={bgImage} alt="" className="h-full w-full object-cover opacity-20 filter grayscale contrast-125" />
            <div className="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/80 to-brand-dark/40" />
        </div>
        
        {/* Decorative elements */}
        <div className="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-brand-dark/50 shadow-xl shadow-brand-primary/10 ring-1 ring-brand-primary/10 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center" />

        <div className="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
            <div className="mx-auto max-w-2xl lg:mx-0">
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.6 }}
                >
                    <h2 className="text-4xl font-black tracking-tight text-white sm:text-6xl uppercase border-l-8 border-brand-primary pl-6">
                        {title}
                    </h2>
                    {subtitle && (
                         <p className="mt-6 text-lg leading-8 text-gray-300 pl-6 border-l-8 border-transparent">
                            {subtitle}
                         </p>
                    )}
                </motion.div>
            </div>
        </div>
    </div>
  );
}
