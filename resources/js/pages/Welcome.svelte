<script lang="ts">
    import { Leaf, Globe, Cpu, ChevronRight } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';
    import CompetitionCard from '@/components/Landing/CompetitionCard.svelte';
    import Countdown from '@/components/Landing/Countdown.svelte';
    import Hero from '@/components/Landing/Hero.svelte';
    import Navbar from '@/components/Landing/Navbar.svelte';

    let {
        competitions = [],
    }: {
        competitions: any[];
    } = $props();

    const stats = [
        { icon: Leaf, title: 'Berkelanjutan', desc: 'Fokus pada inovasi ramah lingkungan.' },
        { icon: Globe, title: 'Nasional', desc: 'Terbuka untuk mahasiswa seluruh Indonesia.' },
        { icon: Cpu, title: 'Teknologi', desc: 'Integrasi teknologi dalam agroindustri.' }
    ];
</script>

<AppHead title="Agridation 2026">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</AppHead>

<div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18]">
    <Navbar />

    <main>
        <Hero />

        <Countdown />

        <!-- Brief Profile Section -->
        <section class="relative py-24 lg:py-32 overflow-hidden">
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-[#7ec335]/5 rounded-full blur-3xl"></div>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-[#3b5c19]/5 px-4 py-1 text-sm font-bold text-[#3b5c19] ring-1 ring-[#3b5c19]/10">
                            <Leaf size={14} />
                            <span>Tentang Agridation</span>
                        </div>
                        <h2 class="mt-6 text-4xl font-black tracking-tight text-[#3b5c19] sm:text-5xl">
                            Membangun Masa Depan <span class="text-[#7ec335]">Agroindustri</span>
                        </h2>
                        <div class="mt-8 space-y-6 text-lg font-medium leading-relaxed text-[#1b1b18]/70">
                            <p>
                                Agridation 2026 merupakan wadah inovasi mahasiswa tingkat nasional yang berkomitmen untuk mengakselerasi transformasi sektor agroindustri di Indonesia.
                            </p>
                            <p>
                                Dengan tema besar <span class="text-[#d57116] font-bold">"Designing Agroindustry for Sustainable Economic Growth"</span>, kami mengajak generasi muda untuk menyumbangkan ide kreatif dan solusi aplikatif yang berdampak nyata bagi ekonomi nasional.
                            </p>
                        </div>

                        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-6">
                            {#each stats as stat}
                                <div class="flex flex-col gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#3b5c19]/5 text-[#3b5c19]">
                                        <stat.icon size={20} />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-[#3b5c19]">{stat.title}</h4>
                                        <p class="text-xs font-medium text-[#1b1b18]/50">{stat.desc}</p>
                                    </div>
                                </div>
                            {/each}
                        </div>
                    </div>

                    <div class="relative">
                        <div class="aspect-square rounded-3xl bg-[#f0e2b8]/20 p-8">
                            <div class="h-full w-full rounded-2xl bg-white shadow-2xl flex items-center justify-center overflow-hidden border border-[#3b5c19]/5">
                                <!-- Official Logo Visual -->
                                <div class="relative flex flex-col items-center">
                                    <div class="absolute -top-12 -left-12 w-24 h-24 bg-[#7ec335]/10 rounded-full blur-xl"></div>
                                    <img src="/logo/logo_agridation.png" alt="Agridation 2026 Logo" class="h-40 w-40 object-contain opacity-80" />
                                    <div class="mt-4 flex flex-col items-center">
                                        <span class="text-3xl font-black text-[#3b5c19]">AGRIDATION</span>
                                        <span class="text-sm font-bold tracking-[0.3em] text-[#7ec335]">EST. 2026</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Competitions Section -->
        <section id="competitions" class="bg-[#f0e2b8]/10 py-24 lg:py-32 border-y border-[#3b5c19]/5">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="max-w-2xl">
                        <h2 class="text-4xl font-black tracking-tight text-[#3b5c19] sm:text-5xl">Cabang Lomba</h2>
                        <p class="mt-4 text-lg font-medium text-[#1b1b18]/60">
                            Pilih disiplin yang sesuai dengan keahlianmu dan jadilah bagian dari perubahan besar dalam dunia agroindustri.
                        </p>
                    </div>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    {#each competitions as competition}
                        <CompetitionCard {competition} />
                    {/each}
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-white py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-8 md:flex-row">
                    <div class="flex flex-col items-center md:items-start gap-2">
                        <div class="flex items-center gap-2">
                             <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-[#3b5c19]/5">
                                <img src="/logo/logo_agridation.png" alt="Agridation" class="h-full w-full object-contain p-1" />
                            </div>
                            <span class="text-xl font-bold tracking-tight text-[#3b5c19]">Agridation 2026</span>
                        </div>
                        <p class="text-sm font-medium text-[#1b1b18]/40">Designing Agroindustry for Sustainable Economic Growth</p>
                    </div>

                    <div class="flex gap-8 text-sm font-bold text-[#3b5c19]">
                        <a href="#" class="hover:text-[#7ec335] transition-colors">Tentang</a>
                        <a href="#competitions" class="hover:text-[#7ec335] transition-colors">Lomba</a>
                        <a href="#" class="hover:text-[#7ec335] transition-colors">Kontak</a>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-[#3b5c19]/5 text-center text-xs font-bold text-[#1b1b18]/30 uppercase tracking-[0.2em]">
                    &copy; 2026 Agridation Nasional. Dikelola oleh Panitia Penyelenggara.
                </div>
            </div>
        </footer>
    </main>
</div>

<style>
    :global(html) {
        scroll-behavior: smooth;
    }

    /* Force light mode styles even if system prefers dark */
    :global(body) {
        background-color: #FDFDFC !important;
        color: #1b1b18 !important;
    }

    /* Animation classes (Tailwind plugins usually handle these, but adding basics for reliability) */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
</style>
