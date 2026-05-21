<script lang="ts">
    import { useForm } from '@inertiajs/svelte';
    import { Users, ClipboardCheck, Trophy } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';
    import DashboardHeader from '@/components/DashboardHeader.svelte';
    import { Badge } from '@/components/ui/badge';
    import { Button } from '@/components/ui/button';
    import {
        Card,
        CardContent,
        CardHeader,
        CardTitle,
    } from '@/components/ui/card';

    interface UserData {
        id: number;
        name: string;
        email: string;
        role: string;
        status: string;
    }

    interface Stats {
        total_users: number;
        pending_verifications: number;
        total_teams: number;
    }

    let { users, stats } = $props<{
        users: UserData[];
        stats: Stats;
    }>();

    const form = useForm();
    function logOut() {
        form.post('/logout');
    }

    function getStatusVariant(status: string) {
        switch (status.toLowerCase()) {
            case 'approved':
                return 'default';
            case 'pending':
                return 'secondary';
            case 'rejected':
                return 'destructive';
            default:
                return 'outline';
        }
    }
</script>

<AppHead title="Admin Dashboard" />

<div class="flex flex-col gap-8 p-6 bg-[#fcfcfc] min-h-screen">
    <DashboardHeader
        title="Admin Dashboard"
        subtitle="Sistem Manajemen Terpadu Agridation 2026"
        onLogOut={logOut}
        processing={form.processing}
    />

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <Card
            class="bg-white shadow-sm border border-[#f0e2b8]/40 hover:border-[#7ec335]/30 transition-all overflow-hidden relative group"
        >
            <div
                class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"
            >
                <Users class="h-24 w-24 text-[#7ec335]" />
            </div>
            <CardHeader class="pb-2">
                <CardTitle
                    class="text-sm font-bold text-muted-foreground uppercase tracking-widest flex items-center gap-2"
                >
                    <Users class="h-4 w-4 text-[#7ec335]" />
                    Total Registrasi
                </CardTitle>
            </CardHeader>
            <CardContent>
                <div class="text-4xl font-black text-[#3b5c19]">
                    {stats.total_users}
                </div>
                <p class="text-xs text-muted-foreground mt-1 font-medium">
                    Peserta Aktif Terdaftar
                </p>
            </CardContent>
            <div class="h-1 w-full bg-[#7ec335]/20">
                <div class="h-1 bg-[#7ec335]" style="width: 100%"></div>
            </div>
        </Card>

        <Card
            class="bg-white shadow-sm border border-[#f0e2b8]/40 hover:border-[#d57116]/30 transition-all overflow-hidden relative group"
        >
            <div
                class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"
            >
                <ClipboardCheck class="h-24 w-24 text-[#d57116]" />
            </div>
            <CardHeader class="pb-2">
                <CardTitle
                    class="text-sm font-bold text-muted-foreground uppercase tracking-widest flex items-center gap-2"
                >
                    <ClipboardCheck class="h-4 w-4 text-[#d57116]" />
                    Menunggu Verifikasi
                </CardTitle>
            </CardHeader>
            <CardContent>
                <div class="text-4xl font-black text-[#3b5c19]">
                    {stats.pending_verifications}
                </div>
                <p class="text-xs text-muted-foreground mt-1 font-medium">
                    KTM & Bukti Pembayaran
                </p>
            </CardContent>
            <div class="h-1 w-full bg-[#d57116]/20">
                <div
                    class="h-1 bg-[#d57116]"
                    style="width: {stats.total_users > 0
                        ? (stats.pending_verifications / stats.total_users) *
                          100
                        : 0}%"
                ></div>
            </div>
        </Card>

        <Card
            class="bg-white shadow-sm border border-[#f0e2b8]/40 hover:border-[#dfad0f]/30 transition-all overflow-hidden relative group"
        >
            <div
                class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"
            >
                <Trophy class="h-24 w-24 text-[#dfad0f]" />
            </div>
            <CardHeader class="pb-2">
                <CardTitle
                    class="text-sm font-bold text-muted-foreground uppercase tracking-widest flex items-center gap-2"
                >
                    <Trophy class="h-4 w-4 text-[#dfad0f]" />
                    Total Tim
                </CardTitle>
            </CardHeader>
            <CardContent>
                <div class="text-4xl font-black text-[#3b5c19]">
                    {stats.total_teams}
                </div>
                <p class="text-xs text-muted-foreground mt-1 font-medium">
                    Tim Terverifikasi
                </p>
            </CardContent>
            <div class="h-1 w-full bg-[#dfad0f]/20">
                <div class="h-1 bg-[#dfad0f]" style="width: 100%"></div>
            </div>
        </Card>
    </div>

    <!-- Users Table -->
    <Card class="bg-white shadow-md border border-[#f0e2b8]/50 overflow-hidden">
        <CardHeader class="bg-white border-b border-[#f0e2b8]/50 py-5">
            <div class="flex items-center justify-between">
                <div>
                    <CardTitle class="text-2xl font-bold text-[#3b5c19]"
                        >Manajemen Peserta</CardTitle
                    >
                    <p class="text-sm text-muted-foreground mt-1">
                        Daftar lengkap seluruh peserta dan status akun mereka.
                    </p>
                </div>
                <Button
                    variant="outline"
                    class="border-[#7ec335] text-[#3b5c19] hover:bg-[#7ec335] hover:text-white font-bold"
                >
                    Export Data (.csv)
                </Button>
            </div>
        </CardHeader>
        <CardContent class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead
                        class="bg-[#fcfcfc] text-[#3b5c19] font-bold uppercase tracking-wider text-xs"
                    >
                        <tr>
                            <th class="p-5 border-b border-[#f0e2b8]/30"
                                >Informasi Peserta</th
                            >
                            <th class="p-5 border-b border-[#f0e2b8]/30"
                                >Peran</th
                            >
                            <th
                                class="p-5 border-b border-[#f0e2b8]/30 text-center"
                                >Status Verifikasi</th
                            >
                            <th
                                class="p-5 border-b border-[#f0e2b8]/30 text-right"
                                >Aksi</th
                            >
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f0e2b8]/20 bg-white">
                        {#each users as user (user.id)}
                            <tr
                                class="hover:bg-[#f0e2b8]/5 transition-colors group"
                            >
                                <td class="p-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-[#3b5c19] group-hover:text-[#7ec335] transition-colors"
                                            >{user.name}</span
                                        >
                                        <span
                                            class="text-xs text-muted-foreground"
                                            >{user.email}</span
                                        >
                                    </div>
                                </td>
                                <td class="p-5">
                                    <Badge
                                        variant="outline"
                                        class="capitalize border-[#f0e2b8] text-[#3b5c19] bg-white font-semibold"
                                    >
                                        {user.role}
                                    </Badge>
                                </td>
                                <td class="p-5 text-center">
                                    <Badge
                                        variant={getStatusVariant(user.status)}
                                        class="px-3 py-1 font-bold"
                                    >
                                        {user.status === 'Not Filled'
                                            ? 'BELUM ISI PROFIL'
                                            : user.status.toUpperCase()}
                                    </Badge>
                                </td>
                                <td class="p-5 text-right">
                                    <Button
                                        size="sm"
                                        variant="ghost"
                                        class="text-[#3b5c19] hover:bg-[#7ec335]/10 hover:text-[#3b5c19] font-bold gap-2"
                                    >
                                        Kelola <span class="text-lg">→</span>
                                    </Button>
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </CardContent>
    </Card>
</div>

<style>
    /* Table styling for better visual separation */
    table {
        border-spacing: 0;
    }
</style>
