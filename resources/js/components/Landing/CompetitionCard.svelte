<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import {
        BriefcaseBusiness,
        MessageSquare,
        Image as ImageIcon,
        Video,
        FileText,
    } from 'lucide-svelte';

    let { competition }: { competition: any } = $props();

    const iconMap: Record<string, any> = {
        bpc: BriefcaseBusiness,
        debate: MessageSquare,
        infografis: ImageIcon,
        video: Video,
        lkti: FileText,
    };

    const Icon = iconMap[competition.id] || FileText;
</script>

<div class="group flex h-full flex-col overflow-hidden rounded-2xl border border-[#3b5c19]/10 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:border-[#3b5c19]/20 hover:shadow-xl">
    <div class="flex flex-1 flex-col p-6">
        <div class="mb-4 flex items-center gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#3b5c19]/5 text-[#3b5c19] transition-transform duration-500 group-hover:scale-110 group-hover:bg-[#3b5c19]/10">
                <Icon size={24} strokeWidth={2} />
            </div>
            <h3 class="text-xl font-bold leading-tight text-[#3b5c19] transition-colors group-hover:text-[#7ec335]">
                {competition.name}
            </h3>
        </div>
        <p class="line-clamp-3 text-sm font-medium leading-relaxed text-[#1b1b18]/60">
            {competition.description}
        </p>
    </div>

    <div class="p-6 pt-0">
        <Link
            href={`/${competition.slug}`}
            class="flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-[#3b5c19] to-[#7ec335] py-3 text-sm font-bold text-white shadow-lg shadow-[#3b5c19]/20 transition-all hover:scale-[1.02] hover:shadow-xl active:scale-95"
        >
            lihat detail
        </Link>
    </div>
</div>
