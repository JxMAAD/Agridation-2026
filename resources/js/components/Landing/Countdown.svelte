<script lang="ts">
    import { onMount, onDestroy } from 'svelte';

    const targetDate = new Date('2026-09-24T00:00:00').getTime();
    
    let days = $state(0);
    let hours = $state(0);
    let minutes = $state(0);
    let seconds = $state(0);
    let interval: any;

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            clearInterval(interval);

            return;
        }

        days = Math.floor(distance / (1000 * 60 * 60 * 24));
        hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((distance % (1000 * 60)) / 1000);
    }

    onMount(() => {
        updateCountdown();
        interval = setInterval(updateCountdown, 1000);
    });

    onDestroy(() => {
        clearInterval(interval);
    });

    const timeUnits = $derived([
        { label: 'Hari', value: days },
        { label: 'Jam', value: hours },
        { label: 'Menit', value: minutes },
        { label: 'Detik', value: seconds },
    ]);
</script>

<section class="bg-[#3b5c19] py-12 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-center gap-8 md:flex-row md:justify-between">
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold">Puncak Acara</h2>
                <p class="mt-1 text-[#c4df45]">24 September 2026 (Hari Tani Nasional)</p>
            </div>
            
            <div class="flex gap-4 sm:gap-6">
                {#each timeUnits as unit}
                    <div class="flex flex-col items-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-white/10 text-2xl font-black backdrop-blur-sm sm:h-20 sm:w-20 sm:text-3xl">
                            {unit.value.toString().padStart(2, '0')}
                        </div>
                        <span class="mt-2 text-xs font-medium uppercase tracking-widest text-[#c4df45]">{unit.label}</span>
                    </div>
                {/each}
            </div>
        </div>
    </div>
</section>
