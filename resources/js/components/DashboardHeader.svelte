<script lang="ts">
    import { LogOut } from 'lucide-svelte';

    interface Props {
        title: string;
        subtitle?: string;
        onLogOut?: () => void;
        processing?: boolean;
        children?: import('svelte').Snippet;
    }

    let { title, subtitle, onLogOut, processing = false, children }: Props = $props();
</script>

<header
    class="flex w-full flex-col justify-between items-start md:items-center md:flex-row border-b border-[#f0e2b8] px-6 pb-6 bg-transparent"
>
    <div class="space-y-1">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight text-[#3b5c19]">
            {title}
        </h1>
        {#if subtitle}
            <p class="text-base md:text-lg text-muted-foreground font-medium">
                {subtitle}
            </p>
        {/if}
    </div>
    
    <div class="flex items-center gap-4 mt-6 md:mt-0 w-full md:w-auto justify-end">
        {#if children}
            {@render children()}
        {/if}

        {#if onLogOut}
            <button
                onclick={onLogOut}
                disabled={processing}
                class="flex items-center gap-2 rounded-xl border-2 border-[#3b5c19]/10 bg-white px-5 py-2.5 text-sm font-bold text-[#3b5c19] transition-all hover:bg-red-50 hover:text-red-600 hover:border-red-100 active:scale-95 disabled:opacity-50 shadow-sm"
            >
                <LogOut size={18} />
                <span class="hidden sm:inline">Keluar</span>
            </button>
        {/if}
    </div>
</header>
