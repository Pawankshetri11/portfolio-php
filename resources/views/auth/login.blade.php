<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal SaaS Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        dark: { 800: '#18181b', 900: '#09090b' }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #09090b; color: #e4e4e7; }
       
        /* Refined Glass Effect */
        .glass-card {
            background: rgba(24, 24, 27, 0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Gold Button Gradient */
        .btn-gold {
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            color: black;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }
        .btn-gold:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
            filter: brightness(1.05);
        }
        .btn-gold:active {
            transform: translateY(0);
        }

        /* Compact Input Styles */
        .input-wrapper {
            position: relative;
            transition: all 0.2s ease;
        }
        .input-field {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s ease;
        }
        .input-field:focus {
            background: rgba(255, 215, 0, 0.05);
            border-color: #ffd700;
            box-shadow: 0 0 0 1px #ffd700;
        }
        .input-icon {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            color: #71717a; transition: color 0.2s;
        }
        .input-field:focus ~ .input-icon { color: #ffd700; }

        /* Smooth Form Switcher */
        .forms-container {
            position: relative;
            overflow: hidden;
            transition: height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-slide {
            position: absolute; top: 0; left: 0; width: 100%;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
            opacity: 0; pointer-events: none;
            transform: translateX(20px);
        }
        .form-slide.active {
            opacity: 1; pointer-events: auto; position: relative;
            transform: translateX(0);
        }
        .form-slide.exit-left { transform: translateX(-20px); opacity: 0; }
        .form-slide.exit-right { transform: translateX(20px); opacity: 0; }

        /* Tab Glider */
        .tab-glider { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
       
        /* Social Buttons */
        .social-btn {
            display: flex; align-items: center; justify-content: center;
            padding: 0.5rem; border-radius: 0.5rem;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.2s;
        }
        .social-btn:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,215,0,0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 selection:bg-yellow-500/30 overflow-hidden">

    <!-- Background Animation -->
    <canvas id="bgCanvas" class="fixed inset-0 z-0"></canvas>
    <div class="fixed inset-0 bg-gradient-to-tr from-yellow-900/10 via-transparent to-purple-900/20 z-0 pointer-events-none mix-blend-overlay"></div>

    <!-- Compact Card -->
    <div class="w-full max-w-[380px] relative z-10">
        <div class="glass-card rounded-2xl overflow-hidden">
           
            <!-- Header -->
            <div class="pt-6 pb-4 text-center">
                <h1 class="text-2xl font-bold tracking-tight text-white">Pawan <span class="text-[#ffd700]">Kshetri</span></h1>
                <p class="text-xs text-zinc-500 mt-1 font-medium">ADMIN ACCESS</p>
            </div>

            <!-- Forms -->
            <div class="px-6 pb-6">
                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-3">
                    @csrf
                    <div class="input-wrapper">
                        <input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}" class="input-field w-full pl-9 pr-3 py-2.5 rounded-lg text-sm bg-transparent text-white placeholder-zinc-600 focus:outline-none" required autofocus autocomplete="username">
                        <svg class="input-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="input-wrapper">
                        <input type="password" placeholder="Password" name="password" class="input-field w-full pl-9 pr-3 py-2.5 rounded-lg text-sm bg-transparent text-white placeholder-zinc-600 focus:outline-none" required autocomplete="current-password">
                        <svg class="input-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-between items-center text-[11px] mt-1">
                        <label class="flex items-center gap-1.5 cursor-pointer text-zinc-400 hover:text-zinc-300">
                            <input type="checkbox" name="remember" class="rounded bg-zinc-800 border-zinc-700 text-[#ffd700] focus:ring-0 w-3.5 h-3.5"> Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[#ffd700] hover:text-[#ffed4e] transition-colors">Forgot password?</a>
                        @endif
                    </div>

                    <button class="btn-gold mt-2 w-full font-bold py-2.5 rounded-lg active:scale-[0.98] text-sm uppercase tracking-wide">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
        <p class="text-center text-[10px] text-zinc-500 mt-4 opacity-60 tracking-wider uppercase">
            © 2024 Pawan Kshetri. All rights reserved.
        </p>
    </div>

    <script>
        (function() {
            // --- Enhanced Constellation Animation ---
            const canvas = document.getElementById('bgCanvas');
            const ctx = canvas.getContext('2d');
            let w, h, particles = [];
           
            const mouse = { x: null, y: null, radius: 150 };

            window.addEventListener('mousemove', (event) => {
                mouse.x = event.x;
                mouse.y = event.y;
            });

            const resize = () => {
                w = canvas.width = window.innerWidth;
                h = canvas.height = window.innerHeight;
            };
            window.addEventListener('resize', resize);
            resize();

            class Particle {
                constructor() {
                    this.x = Math.random() * w;
                    this.y = Math.random() * h;
                    this.directionX = (Math.random() * 2) - 1;
                    this.directionY = (Math.random() * 2) - 1;
                    this.size = (Math.random() * 2) + 0.5; // Slightly smaller stars
                    this.color = '#ffd700';
                }
               
                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                    ctx.fillStyle = this.color;
                    ctx.fill();
                }

                update() {
                    // Check if particle is still within canvas
                    if (this.x > w || this.x < 0) this.directionX = -this.directionX;
                    if (this.y > h || this.y < 0) this.directionY = -this.directionY;

                    // Mouse interaction - push/pull effect or connection
                    let dx = mouse.x - this.x;
                    let dy = mouse.y - this.y;
                    let distance = Math.sqrt(dx*dx + dy*dy);
                   
                    if (distance < mouse.radius) {
                        if (mouse.x < this.x && this.x < w - this.size * 10) {
                            this.x += 2;
                        }
                        if (mouse.x > this.x && this.x > this.size * 10) {
                            this.x -= 2;
                        }
                        if (mouse.y < this.y && this.y < h - this.size * 10) {
                            this.y += 2;
                        }
                        if (mouse.y > this.y && this.y > this.size * 10) {
                            this.y -= 2;
                        }
                    }

                    this.x += this.directionX;
                    this.y += this.directionY;
                    this.draw();
                }
            }

            const init = () => {
                particles = [];
                for (let i = 0; i < 100; i++) {
                    particles.push(new Particle());
                }
            };
            init();

            const animate = () => {
                requestAnimationFrame(animate);
                ctx.clearRect(0, 0, w, h);
                particles.forEach(p => p.update());
            };
            animate();
        })();
    </script>
</body>
</html>
