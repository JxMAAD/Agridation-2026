<script lang="ts">
    import { useForm } from '@inertiajs/svelte';
    import {
        UserCheck,
        Users,
        CreditCard,
        UploadCloud,
        LogOut,
        AlertCircle,
        FileUp,
        UserPlus,
        Wallet,
        FileText,
        Clock,
    } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';
    import { Button } from '@/components/ui/button';

    let { name, role } = $props<{ name: string; role: string }>();

    // Mock state for demonstration purposes - Updated to include Approval Gates
    let currentStep = $state(1); // 1: Verifikasi, 2: Tim, 3: Pembayaran, 4: Submission
    let step1Status = $state('initial'); // 'initial', 'pending', 'approved'
    let step3Status = $state('initial'); // 'initial', 'pending', 'approved'

    // Team formation state
    let selectedCompetition = $state('Business Plan Competition (BPC)');
    let teamMembers = $state([{ name: name, nim: '', isLeader: true }]);

    function addMember() {
        if (teamMembers.length < 3) {
            teamMembers.push({ name: '', nim: '', isLeader: false });
        }
    }

    function removeMember(index: number) {
        if (!teamMembers[index].isLeader) {
            teamMembers.splice(index, 1);
        }
    }

    const form = useForm({});

    function logout() {
        form.post('/logout');
    }

    const steps = [
        { id: 1, title: 'Verifikasi Berkas', icon: UserCheck },
        { id: 2, title: 'Pembentukan Tim', icon: Users },
        { id: 3, title: 'Pembayaran', icon: CreditCard },
        { id: 4, title: 'Pengumpulan Karya', icon: UploadCloud },
    ];

    function getStepColor(stepId: number) {
        if (stepId < currentStep) {
            return 'bg-[#7ec335] text-white border-[#7ec335]';
        } // Done (Green)

        if (stepId === currentStep) {
            if (
                (stepId === 1 && step1Status === 'pending') ||
                (stepId === 3 && step3Status === 'pending')
            ) {
                return 'bg-[#dfad0f] text-white border-[#dfad0f] opacity-70'; // Pending (Yellow muted)
            }

            return 'bg-[#dfad0f] text-white border-[#dfad0f]'; // In Progress (Yellow)
        }

        return 'bg-white text-gray-400 border-gray-200'; // Not Started (Grey)
    }
</script>

<AppHead title="Dasbor Peserta - Agridation 2026" />

<div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18]">
    <!-- Navbar -->
    <nav
        class="sticky top-0 z-50 w-full border-b border-[#3b5c19]/10 bg-white/70 backdrop-blur-xl"
    >
        <div
            class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8"
        >
            <div class="flex items-center">
                <a href="/" class="group flex items-center gap-2.5">
                    <div
                        class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-[#3b5c19]/10"
                    >
                        <img
                            src="/logo/logo_agridation.png"
                            alt="Agridation 2026 Logo"
                            class="h-full w-full object-contain p-1"
                        />
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="text-lg font-bold leading-tight tracking-tight text-[#3b5c19]"
                            >Agridation</span
                        >
                        <span
                            class="text-[10px] font-semibold uppercase tracking-widest text-[#7ec335]"
                            >Peserta Dashboard</span
                        >
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-bold text-[#3b5c19]">{name}</p>
                    <p
                        class="text-[10px] font-medium text-[#1b1b18]/40 uppercase tracking-wider"
                    >
                        {role}
                    </p>
                </div>
                <button
                    onclick={logout}
                    disabled={form.processing}
                    class="flex items-center gap-2 rounded-xl border-2 border-[#3b5c19]/10 px-4 py-2 text-sm font-bold text-[#3b5c19] transition-all hover:bg-red-50 hover:text-red-600 hover:border-red-100 active:scale-95 disabled:opacity-50"
                >
                    <LogOut size={16} />
                    <span class="hidden sm:inline">Keluar</span>
                </button>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <header class="mb-10 text-center sm:text-left">
            <h1
                class="text-3xl font-black tracking-tight text-[#3b5c19] sm:text-4xl"
            >
                Halo, {name}!
            </h1>
            <p class="mt-2 text-lg font-medium text-[#1b1b18]/50 italic">
                Selesaikan pendaftaran tim Anda secara bertahap.
            </p>
        </header>

        <!-- Horizontal Step Progress Bar -->
        <div class="mb-12 grid grid-cols-2 gap-4 sm:grid-cols-4">
            {#each steps as step}
                <div
                    class={`flex flex-col items-center justify-center rounded-2xl border-2 p-4 text-center transition-all ${getStepColor(step.id)}`}
                >
                    <step.icon size={20} class="mb-2" />
                    <span
                        class="text-[10px] font-black uppercase tracking-widest"
                        >{step.title}</span
                    >
                    {#if step.id < currentStep}
                        <span
                            class="mt-1 text-[8px] font-bold opacity-80 italic"
                            >SELESAI</span
                        >
                    {:else if step.id === currentStep}
                        {#if (step.id === 1 && step1Status === 'pending') || (step.id === 3 && step3Status === 'pending')}
                            <span
                                class="mt-1 text-[8px] font-bold opacity-80 italic"
                                >MENUNGGU VERIFIKASI</span
                            >
                        {:else}
                            <span
                                class="mt-1 text-[8px] font-bold opacity-80 italic animate-pulse"
                                >SEDANG BERJALAN</span
                            >
                        {/if}
                    {/if}
                </div>
            {/each}
        </div>

        <!-- Dynamic Action Area -->
        <div
            class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-[#3b5c19]/5 md:p-12"
        >
            {#if currentStep === 1}
                <div class="animate-in fade-in duration-500">
                    <div class="mb-8 flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#dfad0f]/10 text-[#dfad0f]"
                        >
                            <UserCheck size={28} />
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-[#3b5c19]">
                                Verifikasi Berkas
                            </h2>
                            <p class="font-medium text-[#1b1b18]/50">
                                Lengkapi data diri dan unggah berkas
                                persyaratan.
                            </p>
                        </div>
                    </div>

                    {#if step1Status === 'initial'}
                        <!-- Data Diri Form -->
                        <div
                            class="mb-10 grid grid-cols-1 gap-6 md:grid-cols-2"
                        >
                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold uppercase tracking-wider text-[#3b5c19]/60"
                                    for="hp">Nomor HP / WhatsApp</label
                                >
                                <input
                                    type="text"
                                    id="hp"
                                    placeholder="0812..."
                                    class="w-full rounded-xl border-[#3b5c19]/10 bg-[#f8f5e9]/30 p-4 font-medium outline-none ring-2 ring-transparent transition-all focus:ring-[#7ec335]/50"
                                />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold uppercase tracking-wider text-[#3b5c19]/60"
                                    for="ig">Username Instagram</label
                                >
                                <input
                                    type="text"
                                    id="ig"
                                    placeholder="@username"
                                    class="w-full rounded-xl border-[#3b5c19]/10 bg-[#f8f5e9]/30 p-4 font-medium outline-none ring-2 ring-transparent transition-all focus:ring-[#7ec335]/50"
                                />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold uppercase tracking-wider text-[#3b5c19]/60"
                                    for="inst"
                                    >Asal Institusi / Universitas</label
                                >
                                <input
                                    type="text"
                                    id="inst"
                                    placeholder="Nama Kampus"
                                    class="w-full rounded-xl border-[#3b5c19]/10 bg-[#f8f5e9]/30 p-4 font-medium outline-none ring-2 ring-transparent transition-all focus:ring-[#7ec335]/50"
                                />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold uppercase tracking-wider text-[#3b5c19]/60"
                                    for="nim">NIM / Nomor Induk Mahasiswa</label
                                >
                                <input
                                    type="text"
                                    id="nim"
                                    placeholder="12345678"
                                    class="w-full rounded-xl border-[#3b5c19]/10 bg-[#f8f5e9]/30 p-4 font-medium outline-none ring-2 ring-transparent transition-all focus:ring-[#7ec335]/50"
                                />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold uppercase tracking-wider text-[#3b5c19]/60"
                                    for="tgl">Tanggal Lahir</label
                                >
                                <input
                                    type="date"
                                    id="tgl"
                                    class="w-full rounded-xl border-[#3b5c19]/10 bg-[#f8f5e9]/30 p-4 font-medium outline-none ring-2 ring-transparent transition-all focus:ring-[#7ec335]/50"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div
                                class="rounded-2xl border-2 border-dashed border-[#3b5c19]/10 p-8 text-center transition-colors hover:bg-[#3b5c19]/5"
                            >
                                <FileUp
                                    size={32}
                                    class="mx-auto mb-4 text-[#3b5c19]/30"
                                />
                                <p class="text-sm font-bold text-[#3b5c19]">
                                    Unggah KTM Ketua Tim
                                </p>
                                <p class="mt-1 text-xs text-[#1b1b18]/40">
                                    Format: PDF/JPG (Maks 2MB)
                                </p>
                                <Button
                                    variant="outline"
                                    class="mt-4 rounded-xl border-[#3b5c19]/20 font-bold text-[#3b5c19]"
                                    >Pilih File</Button
                                >
                            </div>
                            <div
                                class="rounded-2xl border-2 border-dashed border-[#3b5c19]/10 p-8 text-center transition-colors hover:bg-[#3b5c19]/5"
                            >
                                <FileUp
                                    size={32}
                                    class="mx-auto mb-4 text-[#3b5c19]/30"
                                />
                                <p class="text-sm font-bold text-[#3b5c19]">
                                    Bukti Follow & Twibbon
                                </p>
                                <p class="mt-1 text-xs text-[#1b1b18]/40">
                                    Format: JPG/PNG (Maks 2MB)
                                </p>
                                <Button
                                    variant="outline"
                                    class="mt-4 rounded-xl border-[#3b5c19]/20 font-bold text-[#3b5c19]"
                                    >Pilih File</Button
                                >
                            </div>
                        </div>

                        <div class="mt-10 flex justify-end">
                            <Button
                                class="rounded-2xl bg-[#3b5c19] px-8 py-6 text-lg font-black text-white hover:bg-[#3b5c19]/90"
                                onclick={() => (step1Status = 'pending')}
                            >
                                Kirim & Verifikasi
                            </Button>
                        </div>
                    {:else if step1Status === 'pending'}
                        <div
                            class="flex flex-col items-center justify-center py-10 text-center"
                        >
                            <div
                                class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-[#dfad0f]/10 text-[#dfad0f]"
                            >
                                <Clock size={40} />
                            </div>
                            <h3 class="text-2xl font-black text-[#3b5c19]">
                                Berkas Sedang Diverifikasi
                            </h3>
                            <p
                                class="mt-4 max-w-md font-medium text-[#1b1b18]/50 leading-relaxed"
                            >
                                Mohon tunggu sebentar. Panitia sedang memeriksa
                                KTM dan bukti persyaratan Anda. Status akan
                                berubah secara otomatis setelah disetujui.
                            </p>
                            <div class="mt-10 flex gap-4">
                                <Button
                                    variant="outline"
                                    class="rounded-xl border-[#3b5c19]/10 text-[#3b5c19] font-bold"
                                    onclick={() => (step1Status = 'initial')}
                                    >Edit Berkas</Button
                                >
                                <Button
                                    class="rounded-xl bg-[#7ec335] text-white font-bold"
                                    onclick={() => {
                                        step1Status = 'approved';
                                        currentStep = 2;
                                    }}
                                >
                                    [Mock] Setujui oleh Admin
                                </Button>
                            </div>
                        </div>
                    {/if}
                </div>
            {:else if currentStep === 2}
                <div class="animate-in fade-in duration-500">
                    <div class="mb-8 flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#dfad0f]/10 text-[#dfad0f]"
                        >
                            <UserPlus size={28} />
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-[#3b5c19]">
                                Pembentukan Tim
                            </h2>
                            <p class="font-medium text-[#1b1b18]/50">
                                Pilih cabang lomba dan daftarkan anggota Anda.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div
                            class="rounded-2xl bg-[#7ec335]/5 p-4 flex items-center gap-3 text-xs font-bold text-[#3b5c19] ring-1 ring-[#7ec335]/20"
                        >
                            <AlertCircle size={16} class="text-[#d57116]" />
                            <span
                                >PENTING: Setelah tim difinalisasi, cabang lomba
                                tidak dapat diubah kembali.</span
                            >
                        </div>

                        <div
                            class="rounded-2xl bg-[#f0e2b8]/10 p-6 ring-1 ring-[#f0e2b8]/30"
                        >
                            <label
                                for="lomba"
                                class="mb-2 block text-sm font-black text-[#3b5c19] uppercase tracking-wider"
                                >Pilih Cabang Lomba</label
                            >
                            <select
                                id="lomba"
                                bind:value={selectedCompetition}
                                class="w-full rounded-xl border-[#3b5c19]/10 bg-white p-4 font-bold text-[#3b5c19] outline-none ring-2 ring-transparent transition-all focus:ring-[#7ec335]/50"
                            >
                                <option>Business Plan Competition (BPC)</option>
                                <option>Debat Pertanian Nasional</option>
                                <option>Infografis Competition</option>
                                <option>Creative Video Competition</option>
                                <option>LKTI Nasional</option>
                            </select>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-[#3b5c19] px-2">
                                Data Anggota Tim
                            </h4>

                            {#each teamMembers as member, i}
                                <div
                                    class="relative rounded-2xl border border-[#3b5c19]/10 bg-white p-6 shadow-sm"
                                >
                                    <div
                                        class="mb-4 flex items-center justify-between"
                                    >
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-[#3b5c19]/5 px-3 py-1 text-[10px] font-black text-[#3b5c19] uppercase"
                                        >
                                            {member.isLeader
                                                ? 'Ketua Tim'
                                                : `Anggota ${i + 1}`}
                                        </span>
                                        {#if !member.isLeader}
                                            <button
                                                onclick={() => removeMember(i)}
                                                class="text-xs font-bold text-red-500 hover:text-red-700 uppercase"
                                            >
                                                Hapus
                                            </button>
                                        {/if}
                                    </div>
                                    <div
                                        class="grid grid-cols-1 gap-4 md:grid-cols-2"
                                    >
                                        <div class="space-y-1">
                                            <label
                                                class="text-[10px] font-bold uppercase text-gray-400"
                                                for={`name-${i}`}
                                                >Nama Lengkap</label
                                            >
                                            <input
                                                type="text"
                                                id={`name-${i}`}
                                                bind:value={member.name}
                                                placeholder="Masukkan nama"
                                                class="w-full rounded-lg border-[#3b5c19]/10 bg-[#f8f5e9]/20 p-2.5 text-sm font-medium outline-none focus:ring-1 focus:ring-[#7ec335]"
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <label
                                                class="text-[10px] font-bold uppercase text-gray-400"
                                                for={`nim-${i}`}>NIM</label
                                            >
                                            <input
                                                type="text"
                                                id={`nim-${i}`}
                                                bind:value={member.nim}
                                                placeholder="Masukkan NIM"
                                                class="w-full rounded-lg border-[#3b5c19]/10 bg-[#f8f5e9]/20 p-2.5 text-sm font-medium outline-none focus:ring-1 focus:ring-[#7ec335]"
                                            />
                                        </div>
                                    </div>
                                </div>
                            {/each}

                            {#if teamMembers.length < 3}
                                <button
                                    onclick={addMember}
                                    class="w-full rounded-2xl border-2 border-dashed border-[#3b5c19]/10 p-4 text-sm font-bold text-[#3b5c19]/60 transition-all hover:bg-[#3b5c19]/5 hover:text-[#3b5c19]"
                                >
                                    + Tambah Anggota Tim
                                </button>
                            {/if}
                        </div>
                    </div>

                    <div class="mt-10 flex justify-between">
                        <Button
                            variant="ghost"
                            class="font-bold text-[#1b1b18]/40"
                            onclick={() => {
                                currentStep = 1;
                                step1Status = 'approved';
                            }}>Kembali</Button
                        >
                        <Button
                            class="rounded-2xl bg-[#3b5c19] px-8 py-6 text-lg font-black text-white hover:bg-[#3b5c19]/90"
                            onclick={() => (currentStep = 3)}
                        >
                            Finalisasi Tim & Lanjut
                        </Button>
                    </div>
                </div>
            {:else if currentStep === 3}
                <div class="animate-in fade-in duration-500">
                    <div class="mb-8 flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#dfad0f]/10 text-[#dfad0f]"
                        >
                            <Wallet size={28} />
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-[#3b5c19]">
                                Pembayaran Registrasi
                            </h2>
                            <p class="font-medium text-[#1b1b18]/50">
                                Selesaikan pembayaran untuk membuka menu
                                pengumpulan karya.
                            </p>
                        </div>
                    </div>

                    {#if step3Status === 'initial'}
                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            <div
                                class="rounded-2xl bg-[#3b5c19] p-8 text-white"
                            >
                                <p
                                    class="text-xs font-bold uppercase tracking-[0.2em] text-white/50"
                                >
                                    Total Tagihan
                                </p>
                                <h3 class="mt-2 text-3xl font-black">
                                    Rp 100.000
                                </h3>
                                <div class="mt-8 space-y-4 text-sm font-medium">
                                    <p class="flex justify-between">
                                        <span>Bank</span>
                                        <span class="font-black"
                                            >Bank Syariah Indonesia (BSI)</span
                                        >
                                    </p>
                                    <p class="flex justify-between">
                                        <span>No. Rekening</span>
                                        <span class="font-black"
                                            >7123456789</span
                                        >
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Atas Nama</span>
                                        <span class="font-black"
                                            >Panitia Agridation 2026</span
                                        >
                                    </p>
                                </div>
                            </div>

                            <div
                                class="rounded-2xl border-2 border-dashed border-[#3b5c19]/10 p-8 text-center"
                            >
                                <FileUp
                                    size={32}
                                    class="mx-auto mb-4 text-[#3b5c19]/30"
                                />
                                <p class="text-sm font-bold text-[#3b5c19]">
                                    Unggah Bukti Transfer
                                </p>
                                <p class="mt-2 text-xs text-[#1b1b18]/40">
                                    Harus terlihat jelas: Nominal, Tanggal, dan
                                    No. Referensi.
                                </p>
                                <Button
                                    class="mt-6 w-full rounded-xl bg-[#7ec335] font-bold text-white hover:bg-[#6ba62d]"
                                    onclick={() => (step3Status = 'pending')}
                                    >Pilih Gambar</Button
                                >
                            </div>
                        </div>
                    {:else if step3Status === 'pending'}
                        <div
                            class="flex flex-col items-center justify-center py-10 text-center"
                        >
                            <div
                                class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-[#dfad0f]/10 text-[#dfad0f]"
                            >
                                <Clock size={40} />
                            </div>
                            <h3 class="text-2xl font-black text-[#3b5c19]">
                                Menunggu Verifikasi Pembayaran
                            </h3>
                            <p
                                class="mt-4 max-w-md font-medium text-[#1b1b18]/50 leading-relaxed"
                            >
                                Bukti transfer Anda telah diterima dan sedang
                                divalidasi oleh Bagian Keuangan. Menu Submission
                                akan terbuka setelah pembayaran dikonfirmasi.
                            </p>
                            <div class="mt-10 flex gap-4">
                                <Button
                                    variant="outline"
                                    class="rounded-xl border-[#3b5c19]/10 text-[#3b5c19] font-bold"
                                    onclick={() => (step3Status = 'initial')}
                                    >Ganti Bukti</Button
                                >
                                <Button
                                    class="rounded-xl bg-[#7ec335] text-white font-bold"
                                    onclick={() => {
                                        step3Status = 'approved';
                                        currentStep = 4;
                                    }}
                                >
                                    [Mock] Verifikasi Pembayaran (Admin)
                                </Button>
                            </div>
                        </div>
                    {/if}

                    {#if step3Status === 'initial'}
                        <div class="mt-10 flex justify-start">
                            <Button
                                variant="ghost"
                                class="font-bold text-[#1b1b18]/40"
                                onclick={() => (currentStep = 2)}
                                >Kembali</Button
                            >
                        </div>
                    {/if}
                </div>
            {:else if currentStep === 4}
                <div class="animate-in fade-in duration-500">
                    <div class="mb-8 flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#dfad0f]/10 text-[#dfad0f]"
                        >
                            <FileText size={28} />
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-[#3b5c19]">
                                Pengumpulan Karya
                            </h2>
                            <p class="font-medium text-[#1b1b18]/50">
                                Unggah berkas lomba Anda sesuai dengan tahapan
                                yang aktif.
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-2xl bg-[#7ec335]/5 p-8 ring-1 ring-[#7ec335]/20"
                    >
                        <div class="mb-6 flex items-center justify-between">
                            <div>
                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-[#7ec335] px-3 py-1 text-[10px] font-black text-white uppercase"
                                    >Gate 1 Aktif</span
                                >
                                <h4
                                    class="mt-3 text-xl font-black text-[#3b5c19]"
                                >
                                    Business Model Canvas (BMC)
                                </h4>
                            </div>
                            <p class="text-sm font-bold text-[#d57116]">
                                Deadline: 15 Agustus 2026
                            </p>
                        </div>

                        <div
                            class="rounded-2xl bg-white p-12 text-center shadow-sm"
                        >
                            <UploadCloud
                                size={48}
                                class="mx-auto mb-4 text-[#7ec335]"
                            />
                            <h5 class="text-lg font-bold text-[#3b5c19]">
                                Siap untuk Mengunggah?
                            </h5>
                            <p class="mt-2 text-sm text-[#1b1b18]/40">
                                Seret file Anda ke sini atau klik tombol di
                                bawah.
                            </p>
                            <Button
                                class="mt-8 rounded-2xl bg-[#7ec335] px-10 py-6 text-lg font-black text-white hover:bg-[#6ba62d]"
                                >Unggah Berkas BMC</Button
                            >
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <p
                            class="text-xs font-bold uppercase tracking-widest text-[#1b1b18]/20 italic"
                        >
                            Semua Berkas Akan Dikunci Otomatis Setelah Deadline
                            Terlewati.
                        </p>
                        <Button
                            variant="ghost"
                            class="mt-4 font-bold text-[#3b5c19]"
                            onclick={() => {
                                currentStep = 1;
                                step1Status = 'initial';
                                step3Status = 'initial';
                            }}>Ulangi Simulasi</Button
                        >
                    </div>
                </div>
            {/if}
        </div>
    </main>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
