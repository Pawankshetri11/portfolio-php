<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }} - Pawan Kshetri Portfolio</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif']
                    },
                    colors: {
                        gold: {
                            400: '#ffed4e',
                            500: '#ffd700',
                            600: '#d4b200',
                        },
                    },
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #020202;
            color: #e4e4e7;
        }
        
        .auth-glass {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
        }

        .text-gold-gradient {
            background: linear-gradient(135deg, #fff 20%, #ffd700 80%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
        }

        .auth-input {
            background-color: rgba(12, 12, 12, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 8px;
        }
        
        .auth-input:focus {
            border-color: #ffd700;
            outline: none;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.2);
        }

        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #ffd700, #ff6b6b);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 250px;
            height: 250px;
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .orb-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #a8edea, #fed6e3);
            bottom: 10%;
            left: 50%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Background Animation -->
    <div class="bg-animation">
        <div class="floating-orb orb-1"></div>
        <div class="floating-orb orb-2"></div>
        <div class="floating-orb orb-3"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-display font-bold text-white hover:text-[#ffd700] transition-colors">
                Pawan Kshetri
            </a>
            <a href="/" class="text-zinc-400 hover:text-white transition-colors">
                ← Back to Portfolio
            </a>
        </div>
    </nav>

    <!-- Auth Form -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="auth-glass p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-display font-bold text-white mb-2">{{ $title ?? 'Login' }}</h1>
                    <p class="text-zinc-400">{{ $description ?? 'Access your admin panel' }}</p>
                </div>

                @if (session('status'))
                    <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ $action }}" class="space-y-6">
                    @csrf
                    
                    {{ $slot ?? '' }}

                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Email Address</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               class="w-full px-4 py-3 auth-input transition-all"
                               placeholder="Enter your email">
                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-300 mb-2">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-3 auth-input transition-all"
                               placeholder="Enter your password">
                        @error('password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (isset($remember) && $remember)
                        <div class="flex items-center">
                            <input id="remember_me" 
                                   name="remember" 
                                   type="checkbox" 
                                   class="h-4 w-4 text-[#ffd700] focus:ring-[#ffd700] border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-zinc-300">
                                Remember me
                            </label>
                        </div>
                    @endif

                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-[#ffd700] text-black font-bold rounded-lg shadow-lg hover:bg-white transition-all hover:scale-[1.02]">
                        <i data-lucide="{{ $icon ?? 'log-in' }}" class="w-5 h-5"></i>
                        {{ $buttonText ?? 'Login' }}
                    </button>
                </form>

                @if (isset($footer))
                    <div class="mt-6 text-center text-zinc-400">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html></parameter>
</invoke>
</tool_call>