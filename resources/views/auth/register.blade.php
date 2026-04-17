@extends('frontend.layout')

@section('title', 'Sign Up - Drive Elite')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    /* 🌟 PRO ELITE STYLING */
    .iti { width: 100%; display: block; }
    .iti__country-list { 
        background-color: #0b1120; 
        border: 1px solid rgba(255,255,255,0.1); 
        color: white; 
        border-radius: 1rem; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        font-family: 'Inter', sans-serif;
        z-index: 50;
    }
    .iti__country.iti__highlight { background-color: rgba(249, 115, 22, 0.3); }
    .iti__selected-flag { border-right: 1px solid rgba(255,255,255,0.1); padding: 0 16px; }

    /* 🌟 STYLISH GLOW ANIMATION */
    .elite-card { position: relative; overflow: hidden; }
    .elite-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%);
        animation: rotateGlow 10s linear infinite;
        pointer-events: none;
    }
    @keyframes rotateGlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .orange-shine {
        background: linear-gradient(90deg, #f97316, #fff, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% auto;
        animation: textShine 4s linear infinite;
    }
    @keyframes textShine { to { background-position: 200% center; } }

    ::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.6; cursor: pointer; }
    
    .input-pro {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .input-pro:focus {
        background: rgba(0, 0, 0, 0.5);
        border-color: #f97316;
        box-shadow: 0 0 15px rgba(249, 115, 22, 0.2);
        transform: translateY(-2px);
    }
</style>

<div class="relative min-h-screen flex items-center justify-center pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
    
    <div class="absolute inset-0 z-0 bg-[#0b1120]">
        <img src="https://quickdrive.ae/uploads/200.jpg" 
             class="absolute inset-0 w-full h-full object-cover opacity-100" 
             alt="Luxury Cars Fleet Background">
        <div class="absolute inset-0 bg-gradient-to-b from-[#0b1120] via-black/40 to-[#0b1120]"></div>
    </div>

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-orange-600/20 blur-[120px] rounded-full animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/10 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s;"></div>

    <div class="relative z-10 w-full max-w-2xl" data-aos="zoom-in" data-aos-duration="1000">
        <div class="elite-card bg-white/5 backdrop-blur-2xl border border-white/20 rounded-[3rem] shadow-[0_30px_100px_rgba(0,0,0,0.8)]">
            
            <div class="px-8 md:px-12 py-12">
                <div class="text-center mb-10">
                    <div class="inline-block px-4 py-1 rounded-full bg-orange-500/10 border border-orange-500/20 mb-4">
                        <span class="text-orange-500 text-[10px] font-black uppercase tracking-[0.4em]">Membership Application</span>
                    </div>
                    <h2 class="font-poppins text-4xl md:text-5xl font-black text-white tracking-tighter mb-3 uppercase italic">
                        Join the <span class="orange-shine">Elite</span>
                    </h2>
                    <p class="font-inter text-gray-400 text-sm max-w-sm mx-auto leading-relaxed">Secure your access to Pakistan's most exclusive automotive collection.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6" id="registerForm">
                    @csrf

                    <div class="group">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Full Legal Name</label>
                        <div class="relative">
                            <i class="fa-regular fa-user absolute left-5 top-4 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="John Doe" class="input-pro w-full text-white placeholder-gray-600 rounded-2xl py-4 pl-12 pr-6 outline-none font-inter text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Email Address</label>
                            <div class="relative">
                                <i class="fa-regular fa-envelope absolute left-5 top-4 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="elite@example.com" class="input-pro w-full text-white placeholder-gray-600 rounded-2xl py-4 pl-12 pr-6 outline-none font-inter text-sm">
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Phone Coordinate</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="input-pro w-full text-white rounded-2xl py-4 pl-14 pr-6 outline-none font-inter text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Date of Birth</label>
                            <input type="date" name="dob" value="{{ old('dob') }}" required max="{{ date('Y-m-d', strtotime('-18 years')) }}" class="input-pro w-full text-white rounded-2xl py-4 px-6 outline-none font-inter text-sm">
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Gender Identification</label>
                            <div class="relative">
                                <select name="gender" required class="input-pro w-full text-white rounded-2xl py-4 px-6 outline-none font-inter text-sm appearance-none cursor-pointer">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-5 top-5 text-gray-500 text-xs pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Secure Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-shield-halved absolute left-5 top-4 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                                <input type="password" name="password" required placeholder="••••••••" class="input-pro w-full text-white placeholder-gray-600 rounded-2xl py-4 pl-12 pr-6 outline-none font-inter text-sm">
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Confirm Access</label>
                            <div class="relative">
                                <i class="fa-solid fa-check-double absolute left-5 top-4 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                                <input type="password" name="password_confirmation" required placeholder="••••••••" class="input-pro w-full text-white placeholder-gray-600 rounded-2xl py-4 pl-12 pr-6 outline-none font-inter text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-2">
                        <label class="flex items-center group cursor-pointer">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="driving_license" required class="peer appearance-none w-5 h-5 border-2 border-white/20 rounded-md bg-transparent checked:bg-orange-500 checked:border-orange-500 transition-all">
                                <i class="fa-solid fa-check absolute text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ml-3 text-xs text-gray-400 group-hover:text-gray-200 transition-colors">I confirm holding a valid government Driving License.</span>
                        </label>

                        <label class="flex items-center group cursor-pointer">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="terms" required class="peer appearance-none w-5 h-5 border-2 border-white/20 rounded-md bg-transparent checked:bg-orange-500 checked:border-orange-500 transition-all">
                                <i class="fa-solid fa-check absolute text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ml-3 text-xs text-gray-400 group-hover:text-gray-200 transition-colors">Accept <a href="javascript:void(0)" onclick="showTerms()" class="text-orange-500 font-bold hover:underline">Executive Terms</a>.</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center pt-2">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-theme="dark"></div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="group relative w-full bg-orange-500 hover:bg-orange-600 text-white font-poppins font-black text-xs uppercase italic tracking-[0.4em] py-5 rounded-2xl shadow-[0_15px_30px_rgba(249,115,22,0.4)] transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">Initialize Elite Membership</span>
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        </button>
                    </div>
                </form>

                <p class="text-center text-xs text-gray-500 font-bold mt-10 tracking-widest">
                    ALREADY A MEMBER? <a href="{{ route('login') }}" class="text-white hover:text-orange-500 transition-colors underline underline-offset-8">SIGN IN HERE</a>
                </p>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
            initialCountry: "pk",
            separateDialCode: true,
            preferredCountries: ["pk", "ae", "sa", "us", "uk"]
        });

        document.getElementById("registerForm").addEventListener("submit", function() {
            input.value = iti.getNumber();
        });
    });

    function showTerms() {
        Swal.fire({
            title: 'EXECUTIVE TERMS',
            html: `
                <div style="text-align: left; font-size: 13px; line-height: 1.8; max-height: 300px; overflow-y: auto; padding-right: 15px; font-family: 'Inter';">
                    <h4 style="color: #f97316; font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">01. Documentation</h4>
                    <p style="color: #9ca3af; margin-bottom: 20px;">Verification of a valid driving license and national ID is mandatory before vehicle handover.</p>
                    <h4 style="color: #f97316; font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">02. Fleet Maintenance</h4>
                    <p style="color: #9ca3af; margin-bottom: 20px;">The renter is liable for any mechanical abuse or aesthetic damage during the rental period.</p>
                </div>
            `,
            background: '#070b14',
            color: '#fff',
            confirmButtonText: 'CONFIRM UNDERSTANDING',
            confirmButtonColor: '#f97316',
            width: '550px',
            customClass: { popup: 'border border-white/10 rounded-[2rem] shadow-2xl' }
        });
    }

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Application Error',
                html: `
                    <div style="text-align: left; font-size: 14px; color: #fff; font-family: 'Inter';">
                        <ul style="list-style-type: none; padding: 0; color: #ef4444; font-weight: 600;">
                            @foreach($errors->all() as $error)
                                <li style="margin-bottom: 8px;"><i class="fa-solid fa-circle-exclamation mr-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                `,
                background: '#0b1120',
                confirmButtonColor: '#dc2626'
            });
        });
    @endif
</script>
@endsection