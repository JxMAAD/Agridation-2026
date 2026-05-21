<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
    import { LogIn, UserPlus, LayoutDashboard } from 'lucide-svelte';
    import AppLogo from '@/components/AppLogo.svelte';
    import { toUrl } from '@/lib/utils';
    import { login, register, dashboard } from '@/routes';

    const auth = $derived(page.props.auth);
</script>

<nav class="sticky top-0 z-50 w-full border-b border-[#3b5c19]/10 bg-white/70 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <Link href="/" class="group flex items-center gap-2.5">
                <div class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#3b5c19]/10 transition-transform group-hover:scale-105">
                    <img src="/logo/logo_agridation.png" alt="Agridation 2026 Logo" class="h-full w-full object-contain p-1" />
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold leading-tight tracking-tight text-[#3b5c19]">Agridation</span>
                    <span class="text-[10px] font-semibold uppercase tracking-widest text-[#7ec335]">2026 Edition</span>
                </div>
            </Link>
        </div>

        <div class="flex items-center gap-3 sm:gap-6">
            {#if auth.user}
                <Link
                    href={toUrl(dashboard())}
                    class="flex items-center gap-2 rounded-xl bg-[#3b5c19] px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-[#3b5c19]/20 transition-all hover:bg-[#3b5c19]/90 hover:shadow-xl active:scale-95"
                >
                    <LayoutDashboard size={18} />
                    <span>Dashboard</span>
                </Link>
            {:else}
                <Link
                    href={toUrl(login())}
                    class="flex items-center gap-2 text-sm font-bold text-[#3b5c19] transition-colors hover:text-[#7ec335]"
                >
                    <LogIn size={18} />
                    <span class="hidden sm:inline">Masuk</span>
                </Link>
                <Link
                    href={toUrl(register())}
                    class="flex items-center gap-2 rounded-xl bg-[#3b5c19] px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-[#3b5c19]/20 transition-all hover:bg-[#3b5c19]/90 hover:shadow-xl active:scale-95"
                >
                    <UserPlus size={18} />
                    <span>Daftar</span>
                </Link>
            {/if}
        </div>
    </div>
</nav>
