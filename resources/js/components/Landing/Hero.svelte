<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import { Sprout, ArrowRight, MousePointerClick } from 'lucide-svelte';
    import { toUrl } from '@/lib/utils';
    import { register } from '@/routes';
</script>

<section class="relative overflow-hidden bg-[#FDFDFC] pt-16 pb-24 lg:pt-32 lg:pb-40">
    <!-- Decorative background elements -->
    <div class="absolute -top-24 -right-24 h-[500px] w-[500px] rounded-full bg-[#7ec335]/5 blur-[100px] animate-pulse"></div>
    <div class="absolute top-1/2 -left-24 h-[400px] w-[400px] -translate-y-1/2 rounded-full bg-[#dfad0f]/5 blur-[80px]"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center text-center">
            <div class="mb-10 flex h-24 w-24 items-center justify-center overflow-hidden rounded-3xl bg-white p-3 shadow-2xl shadow-[#3b5c19]/10 ring-1 ring-[#3b5c19]/5 animate-in fade-in zoom-in duration-1000">
                <img src="/logo/logo_agridation.png" alt="Agridation 2026" class="h-full w-full object-contain" />
            </div>

            <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-[#7ec335]/10 px-4 py-1.5 text-sm font-bold text-[#3b5c19] ring-1 ring-[#7ec335]/20 animate-in fade-in slide-in-from-bottom-4 duration-700">
                <Sprout size={16} />
                <span>Pendaftaran Telah Dibuka</span>
            </div>
            
            <h1 class="max-w-4xl text-5xl font-black tracking-tight text-[#3b5c19] sm:text-7xl lg:text-8xl animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-100">
                Agridation <span class="text-[#7ec335]">2026</span>
            </h1>
            
            <p class="mx-auto mt-8 max-w-2xl text-xl font-bold text-[#d57116] md:text-3xl italic leading-tight animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-200">
                "Designing Agroindustry for Sustainable Economic Growth"
            </p>
            
            <p class="mx-auto mt-8 max-w-2xl text-lg font-medium text-[#1b1b18]/60 md:text-xl animate-in fade-in slide-in-from-bottom-10 duration-1000 delay-300">
                Wadah inovasi mahasiswa berskala nasional untuk menciptakan masa depan agroindustri Indonesia yang lebih tangguh dan berkelanjutan.
            </p>
            
            <div class="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-500">
                <Link
                    href={toUrl(register())}
                    class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-[#3b5c19] px-8 py-5 text-lg font-black text-white shadow-2xl shadow-[#3b5c19]/20 transition-all hover:scale-105 hover:bg-[#3b5c19]/90 sm:w-auto active:scale-95"
                >
                    <span>Daftar Sekarang</span>
                    <ArrowRight size={20} class="transition-transform group-hover:translate-x-1" />
                </Link>
                <a
                    href="#competitions"
                    class="group flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-[#3b5c19] px-8 py-5 text-lg font-black text-[#3b5c19] transition-all hover:bg-[#3b5c19]/5 sm:w-auto active:scale-95"
                >
                    <MousePointerClick size={20} />
                    <span>Lihat Lomba</span>
                </a>
            </div>
        </div>
    </div>
</section>
