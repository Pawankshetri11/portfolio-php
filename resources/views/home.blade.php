<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pawan Kshetri | Data Analyst & Full Stack Developer Portfolio</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
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
                        royal: {
                            950: '#020202', // Pitch black (Dark BG)
                            900: '#050505',
                            800: '#0a0a0a',
                            card: '#0c0c0c',
                        },
                        gold: {
                            400: '#ffed4e',
                            500: '#ffd700', // Accent Color
                            600: '#d4b200',
                        },
                    },
                    animation: {
                        'float': 'float 8s ease-in-out infinite',
                        'float-delayed': 'float 8s ease-in-out 4s infinite',
                        'float-reverse': 'float-reverse 9s ease-in-out 2s infinite',
                        'blob': 'blob 20s infinite',
                        'spin-slow': 'spin 20s linear infinite',
                        'pulse-glow': 'pulse-glow 3s infinite',
                        'orbit': 'orbit 20s linear infinite',
                        'process': 'process 3s ease-in-out infinite',
                        'twinkle': 'twinkle 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        'float-reverse': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(20px)' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        'pulse-glow': {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(255, 215, 0, 0.1)' },
                            '50%': { boxShadow: '0 0 40px rgba(255, 215, 0, 0.4)' },
                        },
                        process: {
                            '0%': { width: '0%' },
                            '50%': { width: '100%' },
                            '100%': { width: '0%' }
                        },
                        twinkle: {
                            '0%, 100%': { opacity: 0.2, transform: 'scale(1)' },
                            '50%': { opacity: 1, transform: 'scale(1.2)' }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* --- Base & Scrollbar --- */
        body {
            background-color: #020202; /* Pitch Black */
            color: #e4e4e7; /* Off-White Text */
            overflow-x: hidden;
            transition: background-color 0.3s, color 0.3s;
        }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #020202; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #ffd700; }

        /* --- Refined Glass Effect (Updated for better glow) --- */
        .glass-panel {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            
            /* Light 1px border */
            border: 1px solid rgba(255, 255, 255, 0.08);
            
            /* Reduced Radius */
            border-radius: 12px; 
            
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-out; /* Slightly faster for snappier feel */
        }

        /* Hover Effect: Glow up with Gold - INTENSIFIED */
        .glass-panel:hover {
            border-color: rgba(255, 215, 0, 1) !important; /* Solid Gold Border */
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.3), inset 0 0 10px rgba(255, 215, 0, 0.05); /* Stronger Glow */
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
        }
        
        /* Dark input style used in contact form */
        .input-dark {
            background-color: rgba(12, 12, 12, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 8px; /* Matching radius */
        }
        .input-dark:focus {
            border-color: #ffd700;
            outline: none;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.2);
        }

        /* --- Text Gradients --- */
        .text-gold-gradient {
            background: linear-gradient(135deg, #fff 20%, #ffd700 80%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 4s linear infinite;
        }

        @keyframes shine {
            to { background-position: 200% center; }
        }
        
        /* Timeline Dot */
        .timeline-dot {
            background-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        /* Sticky Header */
        .sticky-header {
            background: rgba(2, 2, 2, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.3s ease;
        }

        /* --- New Background Animations --- */
        .stars-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        
        .star-tiny {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle var(--duration) ease-in-out infinite;
            opacity: 0;
        }

    </style>
</head>
<body class="antialiased selection:bg-[#ffd700] selection:text-black relative">

    
    <!-- BACKGROUND ANIMATION LAYER -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <!-- 1. Gradient Orbs -->
        <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] bg-yellow-900/10 rounded-full mix-blend-screen filter blur-[100px] animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] bg-[#ffd700]/5 rounded-full mix-blend-screen filter blur-[100px] animate-blob" style="animation-delay: 2s"></div>
        
        <!-- 2. Tiny Twinkling Stars (CSS generated) -->
        <div id="starsContainer" class="stars-container"></div>

        <!-- 3. Mesh Canvas (Particles) -->
        <canvas id="meshCanvas" class="opacity-40 absolute inset-0"></canvas>
    </div>

    @include('components.frontend.header-section')

    @include('components.frontend.hero-section')

    @include('components.frontend.key-metrics-section')

    @include('components.frontend.skills-section', ['skillCategories' => $skillCategories])

    @include('components.frontend.experience-section', ['experiences' => $experiences])

    @include('components.frontend.education-section', ['educations' => $educations])

    @include('components.frontend.certifications-section', ['certificates' => $certificates])

    <x-projects-section :projects="$projects" :project-categories="$projectCategories" />

    @include('components.frontend.contact-section', ['contact' => $contact])

    @include('components.frontend.footer-section')
    


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // --- AOS Initialization ---
        AOS.init({
            duration: 800,
            once: true,
            mirror: false,
        });

        // --- Lucide Icons ---
        lucide.createIcons();

        // --- STARFIELD GENERATOR (New) ---
        function createStars() {
            const container = document.getElementById('starsContainer');
            const starCount = 50; 
            
            for(let i=0; i<starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star-tiny');
                
                // Random positioning
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                
                // Random size
                const size = Math.random() * 2 + 1; // 1px to 3px
                
                // Random delay
                const delay = Math.random() * 5;
                const duration = Math.random() * 3 + 2; // 2s to 5s
                
                star.style.left = `${x}%`;
                star.style.top = `${y}%`;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.animationDelay = `${delay}s`;
                star.style.setProperty('--duration', `${duration}s`);
                
                container.appendChild(star);
            }
        }
        createStars();

        // --- MESH CANVAS (Updated) ---
        const canvas = document.getElementById('meshCanvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = document.body.scrollHeight; // Full page height
        }

        window.addEventListener('resize', () => {
             resizeCanvas();
             initParticles();
        });
        resizeCanvas();

        let particles = [];
        const numParticles = window.innerWidth < 768 ? 30 : 60; // Fewer on mobile
        const PARTICLE_COLOR = '#ffd700';

        class Particle {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.size = Math.random() * 2 + 0.5;
                this.speedX = Math.random() * 0.4 - 0.2;
                this.speedY = Math.random() * 0.4 - 0.2;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.x > canvas.width) this.x = 0;
                if (this.x < 0) this.x = canvas.width;
                if (this.y > canvas.height) this.y = 0;
                if (this.y < 0) this.y = canvas.height;
            }
            draw() {
                ctx.fillStyle = PARTICLE_COLOR;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            // Create particles across full height
            for (let i = 0; i < numParticles; i++) {
                const x = Math.random() * canvas.width;
                const y = Math.random() * canvas.height; 
                particles.push(new Particle(x, y));
            }
        }

        function animateCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();

                // Connect lines
                for (let j = i; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 120) {
                        ctx.strokeStyle = `rgba(255, 215, 0, ${0.15 * (1 - distance/120)})`;
                        ctx.lineWidth = 0.5;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animateCanvas);
        }

        initParticles();
        animateCanvas();

    </script>
</body>
</html>