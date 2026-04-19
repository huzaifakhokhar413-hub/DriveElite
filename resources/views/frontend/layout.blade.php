@php
    // 🚀 BULLETPROOF FIX: Agar variable khali hai toh zabardasti DB se uthao
    if (empty($settings)) {
        $settings = \App\Models\Setting::first(); 
    }
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DriveElite Rentals') - Premium Car Rentals</title>
    
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/741/741407.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; overflow-x: hidden; }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #0f172a; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }

        .glass-nav { background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); box-shadow: 0 4px 20px -1px rgba(0, 0, 0, 0.08); }

        /* Custom SweetAlert Ultra-Premium Styles */
        .swal2-timer-progress-bar { background: linear-gradient(90deg, #f97316, #ea580c) !important; height: 4px !important; }
        .premium-swal-popup { border: 1px solid rgba(255,255,255,0.1) !important; box-shadow: 0 30px 60px rgba(0,0,0,0.9) !important; backdrop-filter: blur(20px) !important; }

        /* 🌟 DEVELOPER BRANDING ANIMATIONS 🌟 */
        @keyframes branding-glow {
            0%, 100% { text-shadow: 0 0 15px rgba(249, 115, 22, 0.3); opacity: 1; transform: scale(1); }
            50% { text-shadow: 0 0 30px rgba(249, 115, 22, 0.7); opacity: 0.8; transform: scale(1.02); }
        }
        .animate-branding { animation: branding-glow 4s ease-in-out infinite; }

        /* 🚀 PAGE UP/DOWN BUTTONS (FIXED AT RIGHT MID) 🚀 */
        .scroll-controls { position: fixed; right: 20px; top: 50%; transform: translateY(-50%); display: flex; flex-direction: column; gap: 10px; z-index: 100; }
        .scroll-btn { width: 40px; height: 40px; background: #0f172a; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer; transition: all 0.3s ease; border: 1px solid rgba(249, 115, 22, 0.3); opacity: 0.7; }
        .scroll-btn:hover { background: #f97316; opacity: 1; transform: translateX(-5px); box-shadow: 0 5px 15px rgba(249, 115, 22, 0.4); }

        /* 🚀 MOBILE MENU ANIMATION */
        #mobile-menu { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); transform: translateY(-100%); opacity: 0; pointer-events: none; }
        #mobile-menu.active { transform: translateY(0); opacity: 1; pointer-events: auto; }
    </style>
</head>
<body class="text-gray-800 antialiased selection:bg-orange-500 selection:text-white flex flex-col min-h-screen">

    <div class="scroll-controls">
        <div class="scroll-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Go to Top"><i class="fa-solid fa-chevron-up"></i></div>
        <div class="scroll-btn" onclick="window.scrollTo({top: document.body.scrollHeight, behavior: 'smooth'})" title="Go to Bottom"><i class="fa-solid fa-chevron-down"></i></div>
    </div>

    <nav id="navbar" class="fixed top-0 w-full z-[100] border-b border-gray-100 transition-all duration-300 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center bg-white relative z-50">
            <a href="{{ route('home') }}" class="font-poppins text-2xl font-black text-blue-950 tracking-tight group flex items-center gap-2">
                <i class="fa-solid fa-car-side text-orange-500 group-hover:scale-110 transition-transform"></i>
                <div>Drive<span class="text-orange-500 group-hover:text-orange-600 transition-colors">Elite.</span></div>
            </a>
            
            <div class="hidden md:flex items-center gap-8 font-semibold text-sm text-gray-600 uppercase tracking-wider">
                <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors duration-300">Home</a>
                <a href="{{ route('fleet') }}" class="hover:text-orange-500 transition-colors duration-300">Our Fleet</a>
                <a href="{{ route('about') }}" class="hover:text-orange-500 transition-colors duration-300">About Us</a>
                <a href="{{ route('services') }}" class="hover:text-orange-500 transition-colors duration-300">Services</a>
                <a href="{{ route('contact') }}" class="hover:text-orange-500 transition-colors duration-300">Contact Us</a>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="font-poppins bg-blue-950 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-900 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            My Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 font-bold text-sm text-gray-600 hover:text-blue-950 transition-colors">
                            <i class="fa-regular fa-user text-lg"></i> Log In
                        </a>
                        <a href="{{ route('register') }}" class="font-poppins bg-orange-500 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-orange-600 transition-all shadow-[0_4px_15px_rgba(249,115,22,0.4)] transform hover:-translate-y-0.5">
                            Sign Up
                        </a>
                    @endauth
                </div>

                <button id="menu-toggle" class="md:hidden text-blue-950 text-2xl focus:outline-none p-2">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="absolute top-20 left-0 w-full bg-white z-40 flex flex-col p-6 space-y-6 md:hidden border-b border-gray-100 shadow-xl pb-10">
            <div class="flex flex-col gap-4 text-center">
                <a href="{{ route('home') }}" class="text-lg font-bold text-blue-950 py-3 border-b border-gray-50 uppercase">Home</a>
                <a href="{{ route('fleet') }}" class="text-lg font-bold text-blue-950 py-3 border-b border-gray-50 uppercase">Our Fleet</a>
                <a href="{{ route('about') }}" class="text-lg font-bold text-blue-950 py-3 border-b border-gray-50 uppercase">About Us</a>
                <a href="{{ route('services') }}" class="text-lg font-bold text-blue-950 py-3 border-b border-gray-50 uppercase">Services</a>
                <a href="{{ route('contact') }}" class="text-lg font-bold text-blue-950 py-3 border-b border-gray-50 uppercase">Contact Us</a>
            </div>
            
            <div class="flex flex-col gap-4 mt-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-950 text-white py-4 rounded-xl text-center font-bold uppercase tracking-widest">My Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="border-2 border-blue-950 text-blue-950 py-4 rounded-xl text-center font-bold uppercase tracking-widest"><i class="fa-regular fa-user mr-2"></i> Log In</a>
                    <a href="{{ route('register') }}" class="bg-orange-500 text-white py-4 rounded-xl text-center font-bold shadow-lg uppercase tracking-widest">Sign Up Now</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    @if(isset($settings['whatsapp_link']) && $settings['whatsapp_link'] != '')
    <a href="{{ $settings['whatsapp_link'] }}" target="_blank" class="fixed bottom-6 right-6 z-50 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center text-3xl shadow-[0_10px_20px_rgba(34,197,94,0.4)] hover:bg-green-600 hover:scale-110 transition-all duration-300 animate-bounce" title="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    @endif

    <footer class="bg-[#0b1120] text-gray-300 pt-20 pb-16 border-t-[4px] border-orange-500 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-900/20 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20 relative z-10">
            <div class="lg:col-span-1">
                <h2 class="font-poppins text-3xl font-black tracking-tight mb-6 flex items-center gap-2">
                    <span class="text-white">Drive</span><span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Elite</span>
                </h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Redefining luxury and comfort on the roads of Pakistan. Book your premium vehicle today and experience a journey like never before.
                </p>
                <div class="flex gap-4">
                    @if(isset($settings['facebook_link']) && $settings['facebook_link'] != '') 
                        <a href="{{ $settings['facebook_link'] }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#1877F2] hover:border-[#1877F2] hover:text-white transition-all duration-300"><i class="fa-brands fa-facebook-f"></i></a> 
                    @endif
                    @if(isset($settings['whatsapp_link']) && $settings['whatsapp_link'] != '') 
                        <a href="{{ $settings['whatsapp_link'] }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#25D366] hover:border-[#25D366] hover:text-white transition-all duration-300"><i class="fa-brands fa-whatsapp"></i></a> 
                    @endif
                    @if(isset($settings['instagram_link']) && $settings['instagram_link'] != '') 
                        <a href="{{ $settings['instagram_link'] }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-tr hover:from-[#f09433] hover:to-[#bc1888] hover:border-transparent hover:text-white transition-all duration-300"><i class="fa-brands fa-instagram"></i></a> 
                    @endif
                    @if(isset($settings['youtube_link']) && $settings['youtube_link'] != '') 
                        <a href="{{ $settings['youtube_link'] }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#FF0000] hover:border-[#FF0000] hover:text-white transition-all duration-300"><i class="fa-brands fa-youtube"></i></a> 
                    @endif
                </div>
            </div>
            
            <div>
                <h3 class="font-poppins text-lg font-bold mb-6 text-white uppercase tracking-wider text-sm">Company</h3>
                <ul class="space-y-4 text-sm text-gray-400 font-medium">
                    <li><a href="{{ route('about') }}" class="hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">About Us</a></li>
                    <li><a href="{{ route('fleet') }}" class="hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Our Fleet</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Services</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-poppins text-lg font-bold mb-6 text-white uppercase tracking-wider text-sm">Get In Touch</h3>
                <ul class="space-y-4 text-sm text-gray-400 font-medium">
                    <li class="flex items-start gap-3 group">
                        @php
                            $footer_map_link = !empty($settings['google_map_link']) 
                                ? $settings['google_map_link'] 
                                : "https://www.google.com/maps/search/" . urlencode($settings['company_address'] ?? 'Pakistan');
                        @endphp
                        <a href="{{ $footer_map_link }}" target="_blank" class="hover:text-orange-500 transition-all duration-300 transform group-hover:scale-110">
                            <i class="fa-solid fa-location-dot mt-1 text-orange-500"></i>
                        </a>
                        <span>{{ $settings['company_address'] ?? 'Drive Elite Headquarters, Pakistan' }}</span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <i class="fa-solid fa-phone text-orange-500"></i>
                        <span>{{ $settings['company_phone'] ?? '+92 300 0000000' }}</span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <i class="fa-solid fa-envelope text-orange-500"></i>
                        <a href="mailto:{{ $settings['company_email'] ?? 'info@driveelite.com' }}" class="hover:text-white transition-colors">{{ $settings['company_email'] ?? 'info@driveelite.com' }}</a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="font-poppins text-lg font-bold mb-6 text-white uppercase tracking-wider text-sm">Stay Updated</h3>
                <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for exclusive rental discounts.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="relative">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required class="w-full bg-white/5 border border-white/10 rounded-lg py-3.5 pl-4 pr-12 text-sm text-white focus:outline-none focus:border-orange-500 focus:bg-white/10 transition-all">
                    <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 bg-orange-500 text-white w-10 rounded-md hover:bg-orange-600 transition-colors flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-12 border-t border-white/5 flex flex-col items-center justify-center text-center relative z-10">
            
            <div class="mb-6" data-aos="zoom-in">
                <h2 class="font-poppins text-2xl md:text-4xl font-black tracking-[0.25em] uppercase italic transition-all duration-500 hover:tracking-[0.35em] inline-block animate-branding">
                    <span class="text-white">NN</span> <span class="text-orange-500">DEVELOPERS</span>
                </h2>
            </div>

            <div class="space-y-3" data-aos="fade-up" data-aos-delay="200">
                <p class="text-sm md:text-base font-bold text-gray-400 uppercase tracking-[0.2em] flex items-center justify-center gap-4">
                    <span class="hidden md:block w-12 h-[1px] bg-gradient-to-r from-transparent to-orange-500/50"></span>
                    © 2026 Drive Elite Rentals. All rights reserved.
                    <span class="hidden md:block w-12 h-[1px] bg-gradient-to-l from-transparent to-orange-500/50"></span>
                </p>
                
                <div class="inline-flex items-center gap-3 bg-white/5 px-6 py-2 rounded-full border border-white/10 backdrop-blur-sm group hover:border-orange-500/30 transition-all duration-500">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 group-hover:text-gray-300 transition-colors">
                        Architected & Developed with Precision
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // 🚀 MOBILE MENU TOGGLE SCRIPT
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = menuToggle.querySelector('i');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            if(mobileMenu.classList.contains('active')) {
                menuIcon.classList.remove('fa-bars-staggered');
                menuIcon.classList.add('fa-xmark');
            } else {
                menuIcon.classList.remove('fa-xmark');
                menuIcon.classList.add('fa-bars-staggered');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 1000, once: true, mirror: false, offset: 50 });

            @if(session('success'))
                Swal.fire({
                    html: `<div class="flex flex-col items-center p-4"><div class="w-20 h-20 rounded-full bg-gradient-to-tr from-orange-400 to-orange-600 flex items-center justify-center mb-6 shadow-[0_0_50px_rgba(249,115,22,0.6)] animate__animated animate__pulse animate__infinite"><i class="fa-solid fa-check text-white text-4xl"></i></div><h2 class="font-poppins text-2xl font-black text-white tracking-widest uppercase mb-3 drop-shadow-lg">Success</h2><p class="font-inter text-gray-300 text-base leading-relaxed text-center px-2">{!! session('success') !!}</p></div>`,
                    background: 'rgba(11, 17, 32, 0.85)', backdrop: `rgba(0,0,0,0.8) backdrop-filter: blur(10px)`, showConfirmButton: false, timer: 5000, timerProgressBar: true, customClass: { popup: 'premium-swal-popup rounded-[2rem]' }, showClass: { popup: 'animate__animated animate__fadeInDown' }, hideClass: { popup: 'animate__animated animate__zoomOut' }
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    html: `<div class="flex flex-col items-center p-4"><div class="w-20 h-20 rounded-full bg-gradient-to-tr from-red-500 to-red-700 flex items-center justify-center mb-6 shadow-[0_0_50px_rgba(220,38,38,0.6)] animate__animated animate__headShake"><i class="fa-solid fa-triangle-exclamation text-white text-4xl"></i></div><h2 class="font-poppins text-2xl font-black text-white tracking-widest uppercase mb-3 drop-shadow-lg">Notice</h2><p class="font-inter text-gray-300 text-base leading-relaxed text-center px-2">{{ $errors->first() }}</p></div>`,
                    background: 'rgba(11, 17, 32, 0.85)', backdrop: `rgba(0,0,0,0.8) backdrop-filter: blur(10px)`, showConfirmButton: true, confirmButtonText: 'Try Again', confirmButtonColor: '#f97316', customClass: { popup: 'premium-swal-popup rounded-[2rem]' }, showClass: { popup: 'animate__animated animate__fadeInDown' }, hideClass: { popup: 'animate__animated animate__zoomOut' }
                });
            @endif
        });

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('glass-nav');
                navbar.classList.remove('bg-white');
            } else {
                navbar.classList.remove('glass-nav');
                navbar.classList.add('bg-white');
            }
        });
    </script>
</body>
</html>