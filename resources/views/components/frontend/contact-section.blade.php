<!-- 8. CONTACT SECTION -->
<section id="contact" class="relative z-10 py-16 md:py-24 px-6">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-4">{{ $contact->heading_text ?? 'Get In Touch' }}</h2>
            <p class="text-zinc-400 text-lg mb-8">
                {{ $contact->subtext ?? 'Let\'s connect! Whether it\'s about a project, opportunity, or just to say hi.' }}
            </p>
        </div>

        <div class="glass-panel rounded-xl p-8 md:p-12 grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Left: Channels -->
            <div class="space-y-8">
                <h3 class="text-2xl font-display font-bold text-white">Let's talk!</h3>
                <p class="text-zinc-400">
                    I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision.
                </p>

                <div class="space-y-4">
                    <a href="mailto:{{ $contact->display_email ?? 'pawankshteri11@gmail.com' }}" class="flex items-center gap-4 p-4 rounded-lg bg-white/5 border border-white/5 hover:border-[#ffd700] hover:shadow-[0_0_15px_rgba(255,215,0,0.1)] transition-all">
                        <i data-lucide="mail" class="w-6 h-6 text-[#ffd700]"></i>
                        <div>
                            <p class="text-sm font-bold text-white">Email</p>
                            <p class="text-xs text-zinc-400">{{ $contact->display_email ?? 'pawankshteri11@gmail.com' }}</p>
                        </div>
                    </a>
                    <a href="{{ $contact->linkedin_url ?? 'https://linkedin.com/in/pawankshetri11' }}" target="_blank" class="flex items-center gap-4 p-4 rounded-lg bg-white/5 border border-white/5 hover:border-[#ffd700] hover:shadow-[0_0_15px_rgba(255,215,0,0.1)] transition-all">
                        <i data-lucide="linkedin" class="w-6 h-6 text-[#ffd700]"></i>
                        <div>
                            <p class="text-sm font-bold text-white">LinkedIn</p>
                            <p class="text-xs text-zinc-400">Connect with me</p>
                        </div>
                    </a>
                    <a href="{{ $contact->github_url ?? 'https://github.com/pawankshetri11' }}" target="_blank" class="flex items-center gap-4 p-4 rounded-lg bg-white/5 border border-white/5 hover:border-[#ffd700] hover:shadow-[0_0_15px_rgba(255,215,0,0.1)] transition-all">
                        <i data-lucide="github" class="w-6 h-6 text-[#ffd700]"></i>
                        <div>
                            <p class="text-sm font-bold text-white">GitHub</p>
                            <p class="text-xs text-zinc-400">Check out my repositories</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="space-y-6">
                <form id="contactForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-300 mb-1">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3 input-dark transition-all" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-300 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 input-dark transition-all" required>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-zinc-300 mb-1">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 input-dark transition-all" required></textarea>
                    </div>
                    <button type="submit" id="submitBtn" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-[#ffd700] text-black font-bold rounded-lg shadow-lg hover:bg-white transition-all hover:scale-[1.02]">
                        Send Message <i data-lucide="send" class="w-5 h-5"></i>
                    </button>
                    <div id="formStatus" class="text-center"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const formStatus = document.getElementById('formStatus');
            const formData = new FormData(form);

            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sending...`;

            fetch("{{ route('contact.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formStatus.innerHTML = `<p class="text-green-500">${data.success}</p>`;
                    form.reset();
                } else {
                    let errors = Object.values(data.errors).map(error => `<p>${error}</p>`).join('');
                    formStatus.innerHTML = `<div class="text-red-500">${errors}</div>`;
                }
            })
            .catch(error => {
                formStatus.innerHTML = `<p class="text-red-500">An unexpected error occurred.</p>`;
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Send Message <i data-lucide="send" class="w-5 h-5"></i>';
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        });
    }
});
</script>