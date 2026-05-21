<script lang="ts">
    import { useForm } from '@inertiajs/svelte';
    import { Users, FileText, CheckCircle } from 'lucide-svelte';
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

    interface TeamData {
        id: number;
        team_name: string;
        competition: string;
        leader_name: string;
        status: string;
    }

    interface Stats {
        total_teams: number;
    }

    const form = useForm();
    function logOut() {
        form.post('/logout');
    }

    let { teams, stats } = $props<{
        teams: TeamData[];
        stats: Stats;
    }>();

    function getStatusVariant(status: string) {
        switch (status.toLowerCase()) {
            case 'approved':
            case 'diterima':
                return 'default';
            case 'pending':
                return 'secondary';
            case 'rejected':
            case 'ditolak':
                return 'destructive';
            default:
                return 'outline';
        }
    }
</script>

<AppHead title="Juri Dashboard" />

<div class="flex flex-col gap-6 p-6 bg-[#fcfcfc] min-h-full">
<DashboardHeader 
    title="Juri Dashboard" 
    subtitle="Sistem Manajemen Terpadu Agridation 2026" 
    onLogOut={logOut}
    processing={form.processing}
/>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <Card class="bg-white shadow-sm border-none">
            <CardHeader class="flex flex-row items-center justify-between pb-2">
                <CardTitle class="text-sm font-medium text-muted-foreground"
                    >Total Tim Dinilai</CardTitle
                >
                <Users class="h-4 w-4 text-[#7ec335]" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">{stats.total_teams}</div>
                <p class="text-xs text-muted-foreground">
                    Peserta terverifikasi
                </p>
            </CardContent>
        </Card>

        <Card class="bg-white shadow-sm border-none">
            <CardHeader class="flex flex-row items-center justify-between pb-2">
                <CardTitle class="text-sm font-medium text-muted-foreground"
                    >Selesai Dinilai</CardTitle
                >
                <CheckCircle class="h-4 w-4 text-[#dfad0f]" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">0</div>
                <p class="text-xs text-muted-foreground">
                    Dari {stats.total_teams} tim
                </p>
            </CardContent>
        </Card>

        <Card class="bg-white shadow-sm border-none">
            <CardHeader class="flex flex-row items-center justify-between pb-2">
                <CardTitle class="text-sm font-medium text-muted-foreground"
                    >Berkas Masuk</CardTitle
                >
                <FileText class="h-4 w-4 text-[#c4df45]" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">{stats.total_teams}</div>
                <p class="text-xs text-muted-foreground">Siap untuk dinilai</p>
            </CardContent>
        </Card>
    </div>

    <!-- Participant Table -->
    <Card class="bg-white shadow-sm border-none">
        <CardHeader>
            <CardTitle class="text-xl font-semibold text-[#3b5c19]"
                >Daftar Peserta Kompetisi</CardTitle
            >
        </CardHeader>
        <CardContent>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#f0e2b8]/30 text-[#3b5c19] font-semibold">
                        <tr>
                            <th class="p-4 border-b">Nama Tim</th>
                            <th class="p-4 border-b">Ketua</th>
                            <th class="p-4 border-b">Kompetisi</th>
                            <th class="p-4 border-b">Status Berkas</th>
                            <th class="p-4 border-b text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f0e2b8]/20">
                        {#each teams as team (team.id)}
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="p-4 font-bold text-[#3b5c19]"
                                    >{team.team_name}</td
                                >
                                <td class="p-4 text-muted-foreground"
                                    >{team.leader_name}</td
                                >
                                <td class="p-4">
                                    <Badge
                                        variant="outline"
                                        class="border-[#c4df45]"
                                        >{team.competition}</Badge
                                    >
                                </td>
                                <td class="p-4">
                                    <Badge
                                        variant={getStatusVariant(team.status)}
                                    >
                                        {team.status}
                                    </Badge>
                                </td>
                                <td class="p-4 text-right">
                                    <Button
                                        size="sm"
                                        class="bg-[#7ec335] hover:bg-[#3b5c19] text-white text-xs"
                                    >
                                        Buka Berkas
                                    </Button>
                                </td>
                            </tr>
                        {:else}
                            <tr>
                                <td
                                    colspan="5"
                                    class="p-8 text-center text-muted-foreground italic"
                                >
                                    Belum ada peserta yang terverifikasi di
                                    kategori Anda.
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
    table {
        border-collapse: separate;
        border-spacing: 0;
    }
    th:first-child {
        border-top-left-radius: 8px;
    }
    th:last-child {
        border-top-right-radius: 8px;
    }
</style>
