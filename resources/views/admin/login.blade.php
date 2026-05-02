<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Drive Elite</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* 🚀 NEXT LEVEL ANIMATED BACKGROUND */
        .vault-bg {
            background: linear-gradient(135deg, rgba(11, 17, 32, 0.95) 0%, rgba(15, 23, 42, 0.9) 100%), 
                        url('https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* 🌟 GLASSMORPHISM CARD */
        .glass-panel {
            background: rgba(11, 17, 32, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* ⚡ GLOWING INPUTS */
        .elite-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        .elite-input:focus {
            background: rgba(249, 115, 22, 0.05);
            border-color: rgba(249, 115, 22, 0.5);
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.2);
        }

        /* 🔐 RADAR ANIMATION FOR ICON */
        @keyframes radar {
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4); }
            70% { box-shadow: 0 0 0 20px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }
        .radar-icon { animation: radar 2s infinite; }
    </style>
</head>
<!-- 🚀 Fix: Removed overflow-hidden and added overflow-x-hidden, added py-12 for scroll spacing -->
<body class="vault-bg min-h-screen flex items-center justify-center p-6 py-12 text-white overflow-x-hidden relative">

    <!-- Ambient Glowing Orbs in Background -->
    <div class="fixed top-[-10%] left-[-10%] w-96 h-96 bg-orange-600/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-600/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="glass-panel w-full max-w-lg rounded-[2.5rem] p-10 md:p-14 relative z-10 my-auto">
        
        <!-- HEADER -->
        <div class="text-center mb-10 relative">
            <div class="w-20 h-20 bg-orange-500/10 border border-orange-500/30 rounded-2xl flex items-center justify-center mx-auto mb-6 radar-icon">
                <i class="fa-solid fa-fingerprint text-3xl text-orange-500"></i>
            </div>
            <h1 class="font-poppins text-3xl font-black uppercase italic tracking-[0.2em] mb-2">Drive<span class="text-orange-500">Elite</span></h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.4em]">Admin Login</p>
        </div>

        <!-- ERROR MESSAGE SHOWCASE -->
        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-8 flex items-start gap-3">
                <i class="fa-solid fa-triangle-exclamation text-red-500 mt-1"></i>
                <div class="text-xs text-red-200 font-medium tracking-wide leading-relaxed">
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <!-- LOGIN FORM -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="group">
                <!-- 🚀 Fix: Simple English -->
                <label class="block text-[9px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-envelope text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                    </div>
                    <!-- 🚀 Fix: Simple Placeholder -->
                    <input type="email" name="email" required autocomplete="email" placeholder="admin@driveelite.com" 
                           class="elite-input w-full rounded-2xl py-4 pl-12 pr-5 text-sm text-white placeholder-gray-600 outline-none">
                </div>
            </div>

            <div class="group">
                <!-- 🚀 Fix: Simple English -->
                <label class="block text-[9px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••••••" 
                           class="elite-input w-full rounded-2xl py-4 pl-12 pr-5 text-sm text-white placeholder-gray-600 outline-none tracking-widest">
                </div>
            </div>

            <!-- 🚀 Fix: Simple Button Text -->
            <button type="submit" class="w-full relative group overflow-hidden bg-white text-[#0b1120] font-black py-4 rounded-2xl uppercase tracking-[0.3em] text-xs transition-all hover:scale-[1.02] active:scale-95 mt-4">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-orange-400 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <span class="relative z-10 flex items-center justify-center gap-3 group-hover:text-white transition-colors">
                    Login <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </span>
            </button>
        </form>

        <!-- SECURITY WARNING -->
        <div class="mt-10 text-center border-t border-white/5 pt-6">
            <p class="text-[8px] text-gray-500 uppercase tracking-[0.2em] leading-relaxed flex items-center justify-center gap-2">
                <i class="fa-solid fa-shield text-green-500/70"></i> Secured Connection
            </p>
        </div>

    </div>

</body>
</html>