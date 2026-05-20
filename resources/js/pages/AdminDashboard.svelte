<script lang="ts">
    import AppHead from '@/components/AppHead.svelte';
    import { useForm } from '@inertiajs/svelte';
    import { Button } from '@/components/ui/button';

    let { name, role } = $props<{ name: string; role: string }>();

    const form = useForm({});

    function logout() {
        form.post('/logout');
    }
</script>

<AppHead title="Admin Dashboard" />

<div class="p-8">
    <p class="mb-4">Hello {name}!. your role is: {role}.</p>

    <Button variant="destructive" onclick={logout} disabled={form.processing}>
        Keluar (Logout)
    </Button>
</div>
