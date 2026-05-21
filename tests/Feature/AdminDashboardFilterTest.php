<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleTableSeeder;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleTableSeeder::class);
});

test('admin dashboard only lists peserta users and excludes admin and juri', function () {
    // Create admin
    $admin = User::factory()->create(['name' => 'Admin User']);
    $admin->assignRole('admin');

    // Create juri
    $juri = User::factory()->create(['name' => 'Juri User']);
    $juri->assignRole('juri');

    // Create peserta (explicit role)
    $peserta1 = User::factory()->create(['name' => 'Peserta One']);
    $peserta1->assignRole('peserta');

    // Create peserta (implicit role - no role assigned)
    $peserta2 = User::factory()->create(['name' => 'Peserta Two']);

    $this->actingAs($admin);

    // The route is /admin/dashboard as seen in AdminDashboardController
    $response = $this->get('/admin/dashboard');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Dashboard')
        ->has('users', 2)
        ->where('users.0.name', 'Peserta One')
        ->where('users.1.name', 'Peserta Two')
        ->where('stats.total_users', 2)
    );

    // Double check that Admin and Juri are not in the users list
    $users = $response->viewData('page')['props']['users'];
    $userNames = collect($users)->pluck('name');

    expect($userNames)->not->toContain('Admin User');
    expect($userNames)->not->toContain('Juri User');
});

test('admin dashboard pending verifications count only includes peserta', function () {
    // Create admin
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Create peserta with pending profile
    $peserta = User::factory()->create();
    // Profile is created automatically or manually?
    // Let's create it manually for the test
    \App\Models\Profile::create([
        'user_id' => $peserta->id,
        'nim' => '12345678',
        'birth_date' => '2000-01-01',
        'phone' => '08123456789',
        'instagram' => 'test_ig',
        'institution' => 'Test University',
        'status' => 'pending',
    ]);

    // Create another user (e.g. juri) with pending profile
    $juri = User::factory()->create();
    $juri->assignRole('juri');
    \App\Models\Profile::create([
        'user_id' => $juri->id,
        'nim' => '87654321',
        'birth_date' => '1990-01-01',
        'phone' => '08987654321',
        'instagram' => 'juri_ig',
        'institution' => 'Juri University',
        'status' => 'pending',
    ]);

    $this->actingAs($admin);

    $response = $this->get('/admin/dashboard');

    $response->assertInertia(fn (Assert $page) => $page
        ->where('stats.pending_verifications', 1)
    );
});
