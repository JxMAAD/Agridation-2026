<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import { 
        Calendar, 
        BookOpen, 
        Trophy, 
        Download, 
        ChevronRight,
        ArrowLeft,
        Target
    } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';
    import Navbar from '@/components/Landing/Navbar.svelte';
    import { toUrl } from '@/lib/utils';
    import { register } from '@/routes';

    let {
        competition,
        canRegister = true
    }: {
        competition: any;
        canRegister: boolean;
    } = $props();

    let activeTab = $state('tema');

    const tabs = [
        { id: 'tema', label: 'Tema', icon: Target },
        { id: 'timeline', label: 'Timeline', icon: Calendar },
        { id: 'ketentuan', label: 'Ketentuan', icon: BookOpen }
    ];
</script>

<AppHead title={`${competition.name} - Agridation 2026`} />

<div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18]">
    <Navbar />

    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <!-- Breadcrumbs / Back Link -->
        <div class="mb-8">
            <Link href="/" class="group inline-flex items-center gap-2 text-sm font-bold text-[#3b5c19] hover:text-[#7ec335]">
                <ArrowLeft size={16} class="transition-transform group-hover:-translate-x-1" />
                <span>Kembali ke Beranda</span>
            </Link>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2">
                <header class="mb-10">
                    <h1 class="text-4xl font-black tracking-tight text-[#3b5c19] sm:text-5xl">
                        {competition.name}
                    </h1>
                    <p class="mt-4 text-lg font-medium leading-relaxed text-[#1b1b18]/70">
                        {competition.description}
                    </p>
                </header>

                <!-- Tab Menu -->
                <div class="mb-8 flex border-b border-[#3b5c19]/10">
                    {#each tabs as tab}
                        <button
                            onclick={() => activeTab = tab.id}
                            class={`flex items-center gap-2 border-b-2 px-6 py-4 text-sm font-bold transition-all ${
                                activeTab === tab.id
                                    ? 'border-[#3b5c19] text-[#3b5c19]'
                                    : 'border-transparent text-[#1b1b18]/40 hover:text-[#3b5c19]/60'
                            }`}
                        >
                            <tab.icon size={18} />
                            <span>{tab.label}</span>
                        </button>
                    {/each}
                </div>

                <!-- Tab Content -->
                <div class="min-h-[400px] rounded-3xl bg-white p-8 shadow-sm ring-1 ring-[#3b5c19]/5">
                    {#if activeTab === 'tema'}
                        <div class="animate-in fade-in duration-500">
                            <h3 class="mb-6 flex items-center gap-3 text-2xl font-black text-[#3b5c19]">
                                <Target class="text-[#7ec335]" />
                                <span>Sub-Tema Perlombaan</span>
                            </h3>
                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                {#each competition.themes as theme}
                                    <li class="flex items-start gap-3 rounded-2xl bg-[#7ec335]/5 p-4 ring-1 ring-[#7ec335]/10">
                                        <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#7ec335] text-white">
                                            <ChevronRight size={14} />
                                        </div>
                                        <span class="font-bold text-[#3b5c19]">{theme}</span>
                                    </li>
                                {/each}
                            </ul>
                        </div>
                    {:else if activeTab === 'timeline'}
                        <div class="animate-in fade-in duration-500">
                            <h3 class="mb-8 flex items-center gap-3 text-2xl font-black text-[#3b5c19]">
                                <Calendar class="text-[#7ec335]" />
                                <span>Timeline Kegiatan</span>
                            </h3>
                            <div class="relative space-y-8 before:absolute before:left-4 before:top-2 before:h-[calc(100%-16px)] before:w-0.5 before:bg-[#3b5c19]/10">
                                {#each competition.timeline as item}
                                    <div class="relative pl-12">
                                        <div class="absolute left-0 top-1.5 h-8 w-8 rounded-full border-4 border-white bg-[#7ec335] shadow-sm"></div>
                                        <div>
                                            <h4 class="text-lg font-black text-[#3b5c19]">{item.event}</h4>
                                            <p class="font-bold text-[#d57116]">{item.date}</p>
                                        </div>
                                    </div>
                                {/each}
                            </div>
                        </div>
                    {:else if activeTab === 'ketentuan'}
                        <div class="animate-in fade-in duration-500">
                            <h3 class="mb-6 flex items-center gap-3 text-2xl font-black text-[#3b5c19]">
                                <BookOpen class="text-[#7ec335]" />
                                <span>Ketentuan Umum</span>
                            </h3>
                            <ul class="space-y-4">
                                {#each competition.rules as rule}
                                    <li class="flex items-start gap-4 text-lg font-medium text-[#1b1b18]/70">
                                        <div class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-[#d57116]"></div>
                                        <span>{rule}</span>
                                    </li>
                                {/each}
                            </ul>
                        </div>
                    {/if}
                </div>
            </div>

            <!-- Right Column: Sidebar CTA -->
            <div class="lg:sticky lg:top-28 lg:h-fit">
                <div class="rounded-3xl bg-[#3b5c19] p-8 text-white shadow-2xl shadow-[#3b5c19]/20">
                    <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 text-white">
                        <Trophy size={32} />
                    </div>
                    <h3 class="text-2xl font-black">Siap untuk Berinovasi?</h3>
                    <p class="mt-4 font-medium text-white/70 leading-relaxed">
                        Daftarkan timmu sekarang dan jadilah bagian dari perubahan masa depan agroindustri.
                    </p>

                    <div class="mt-8 space-y-4">
                        <Link
                            href={toUrl(register())}
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-[#7ec335] py-4 text-lg font-black text-white transition-all hover:scale-[1.02] hover:bg-[#7ec335]/90 active:scale-95"
                        >
                            <span>Daftar Sekarang!</span>
                            <ChevronRight size={20} />
                        </Link>
                        <a
                            href={competition.guidebook_url}
                            class="flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-white/20 py-4 text-lg font-black text-white transition-all hover:bg-white/10 active:scale-95"
                        >
                            <Download size={20} />
                            <span>Unduh Guidebook</span>
                        </a>
                    </div>

                    <div class="mt-8 border-t border-white/10 pt-6">
                        <p class="text-xs font-bold uppercase tracking-widest text-white/40">Informasi Tambahan</p>
                        <p class="mt-2 text-sm font-medium text-white/60 italic">
                            *Pendaftaran akan ditutup otomatis pada tanggal deadline pukul 23:59 WIB.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
    /* Animation classes */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
