@extends('frontend.layout')

@section('title', 'Our Services - Drive Elite')

@section('content')

<style>
    .service-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 2rem; padding: 3rem; transition: all 0.5s ease; border: 1px solid #f1f5f9; }
    .service-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.1); border-color: #f97316; background: white; }
    .icon-box { width: 70px; height: 70px; background: #fff7ed; color: #f97316; border-radius: 1.2rem; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 2rem; transition: all 0.5s ease; }
    .service-card:hover .icon-box { background: #f97316; color: white; transform: rotateY(180deg); }
    
    /* 🚀 BACKGROUND IMAGE SECTION STYLING */
    .services-bg { 
        background: linear-gradient(rgba(11, 17, 32, 0.8), rgba(11, 17, 32, 0.8)), 
                    url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=1983&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Parallax Effect */
    }
</style>

<div class="services-bg pt-48 pb-40 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 mb-6 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
            <span class="text-orange-500 text-[10px] font-black tracking-[0.3em] uppercase">Elite Experience</span>
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-white italic uppercase tracking-tighter mb-6">Premium <span class="text-orange-500">Services.</span></h1>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto font-light leading-relaxed">
            From self-drive freedom to executive protection, we redefine how the elite travel across Pakistan.
        </p>
    </div>
</div>

<section class="py-32 bg-[#f8fafc] relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <div class="service-card" data-aos="fade-up">
                <div class="icon-box"><i class="fa-solid fa-key"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Self-Drive Freedom</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Take total control. Choose your favorite machine from our elite fleet and drive it wherever you want with complete privacy.</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box"><i class="fa-solid fa-user-tie"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Chauffeur Service</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Sit back and relax. Our professional, uniformed VIP drivers will handle the road while you focus on your business or leisure.</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box"><i class="fa-solid fa-plane-arrival"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Airport Transfers</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Never miss a flight. We provide timely and luxury pickup/drop services to and from all major airports in Pakistan.</p>
            </div>

            <div class="service-card" data-aos="fade-up">
                <div class="icon-box"><i class="fa-solid fa-ring"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Wedding Events</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Make your special day more memorable. Rent our most exotic cars like Rolls Royce or V8 for a grand entrance.</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box"><i class="fa-solid fa-briefcase"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Corporate Fleet</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Elevate your business image. We provide long-term rental solutions for companies and executive guests.</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">VIP Protection</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Safety first. We offer bulletproof vehicles and security escort services for high-profile movement.</p>
            </div>

            <div class="service-card" data-aos="fade-up">
                <div class="icon-box"><i class="fa-solid fa-calendar-check"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Event Logistics</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Managing luxury transport for large events, conferences, or delegations with a dedicated fleet manager.</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box"><i class="fa-solid fa-route"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">Inter-City Travel</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Seamless travel between cities like Lahore, Islamabad, and Karachi in the comfort of our luxury sedans.</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box"><i class="fa-solid fa-headset"></i></div>
                <h3 class="text-2xl font-black text-[#0b1120] mb-4 uppercase italic">24/7 Support</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Dedicated roadside assistance and customer support at any time of the day or night, anywhere in Pakistan.</p>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-[#0b1120] relative">
    <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');"></div>
    <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-4xl font-black text-white italic uppercase mb-8">Ready to experience the <span class="text-orange-500">Elite</span> standard?</h2>
        <a href="{{ route('contact') }}" class="inline-block bg-orange-500 text-white px-14 py-6 rounded-2xl font-black text-[11px] uppercase tracking-[0.4em] hover:bg-white hover:text-[#0b1120] transition-all shadow-[0_15px_30px_rgba(249,115,22,0.3)] italic">Contact Concierge Now</a>
    </div>
</section>

@endsection