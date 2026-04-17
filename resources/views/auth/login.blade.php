@extends('frontend.layout')

@section('title', 'Log In - Drive Elite')

@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    /* 🌟 STYLISH GLOW ANIMATION (Like Register) */
    .elite-card { position: relative; overflow: hidden; }
    .elite-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(249, 115, 22, 0.15) 0%, transparent 70%);
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

    <div class="relative z-10 w-full max-w-md" data-aos="zoom-in" data-aos-duration="1000">
        <div class="elite-card bg-white/5 backdrop-blur-2xl border border-white/20 rounded-[3rem] shadow-[0_30px_100px_rgba(0,0,0,0.8)]">
            
            <div class="px-8 py-12">
                <div class="text-center mb-10">
                    <div class="w-16 h-16 bg-gradient-to-tr from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-orange-500/30">
                        <i class="fa-solid fa-user-lock text-white text-2xl"></i>
                    </div>
                    <h2 class="font-poppins text-4xl font-black text-white tracking-tighter mb-3 uppercase italic">
                        Welcome <span class="orange-shine">Back</span>
                    </h2>
                    <p class="font-inter text-gray-400 text-sm font-medium leading-relaxed">Access your elite command center.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                    @csrf

                    <div class="group">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Secure Email</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-5 top-4 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="elite@example.com" class="input-pro w-full text-white placeholder-gray-600 rounded-2xl py-4 pl-12 pr-6 outline-none font-inter text-sm shadow-inner">
                        </div>
                    </div>

                    <div class="group">
                        <div class="flex justify-between items-center mb-2 ml-2 pr-2">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em]">Access Key</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[9px] font-black text-white hover:text-orange-400 transition-colors tracking-widest uppercase">Forgot Key?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <i class="fa-solid fa-shield-halved absolute left-5 top-4 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                            <input type="password" name="password" required placeholder="••••••••" class="input-pro w-full text-white placeholder-gray-600 rounded-2xl py-4 pl-12 pr-6 outline-none font-inter text-sm shadow-inner">
                        </div>
                    </div>

                    <div class="flex items-center ml-2">
                        <label class="flex items-center group cursor-pointer">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="remember" id="remember" class="peer appearance-none w-5 h-5 border-2 border-white/20 rounded-md bg-transparent checked:bg-orange-500 checked:border-orange-500 transition-all">
                                <i class="fa-solid fa-check absolute text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ml-3 text-xs text-gray-400 group-hover:text-gray-200 transition-colors font-medium">Keep session active for 30 days</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center pt-2">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-theme="dark"></div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="group relative w-full bg-orange-500 hover:bg-orange-600 text-white font-poppins font-black text-xs uppercase italic tracking-[0.4em] py-5 rounded-2xl shadow-[0_15px_30px_rgba(249,115,22,0.4)] transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">Login</span>
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        </button>
                    </div>
                </form>

                <div class="flex items-center my-8">
                    <div class="flex-grow border-t border-white/10"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-500 text-[10px] uppercase tracking-widest font-black">Secure Auth Bridge</span>
                    <div class="flex-grow border-t border-white/10"></div>
                </div>

                <div class="space-y-4">
                    <a href="#" class="flex items-center justify-center gap-3 w-full bg-white/5 border border-white/10 hover:bg-white/10 text-white py-4 rounded-2xl transition-all font-inter text-sm font-medium shadow-sm">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google"> Continue with Google
                    </a>
                </div>

                <p class="text-center text-xs text-gray-500 font-bold mt-10 tracking-widest">
                    NEW TO THE FLEET? <a href="{{ route('register') }}" class="text-white hover:text-orange-500 transition-colors underline underline-offset-8">CREATE ACCOUNT</a>
                </p>

            </div>
        </div>
    </div>
</div>

<script>
    // reCAPTCHA Validation for Login Form
    document.getElementById("loginForm").addEventListener("submit", function(e) {
        var response = grecaptcha.getResponse();
        if(response.length == 0) {
            e.preventDefault();
            alert("Please complete the reCAPTCHA verification to proceed.");
            return false;
        }
    });

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'ACCESS DENIED',
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
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'RETRY ACCESS',
                customClass: { popup: 'border border-red-500/20 rounded-[2rem]' }
            });
        });
    @endif
</script>
@endsection