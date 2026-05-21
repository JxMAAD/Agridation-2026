<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Judges;
use App\Models\Competitions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Create Admin
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@agridation.com',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
        ]);
        $admin->assignRole('admin');

        // 2. Define Competitions
        $competitionsData = [
            [
                'name' => 'Business Plan Competition',
                'slug' => 'business-plan-competition',
                'description' => 'Fokus inovasi agroindustri (pengolahan, rantai pasok, circular economy).',
                'type' => 'team',
                'price' => 100000,
                'max_member' => 3,
            ],
            [
                'name' => 'Debate (Debat Pertanian Nasional)',
                'slug' => 'debate',
                'description' => 'Sistem Asian Parliamentary Debate merespons mosi agroindustri.',
                'type' => 'team',
                'price' => 0,
                'max_member' => 3,
            ],
            [
                'name' => 'Infografis Competition',
                'slug' => 'infografis',
                'description' => 'Lomba desain visual edukatif dengan tema agroindustri.',
                'type' => 'individual',
                'price' => 35000,
                'max_member' => 1,
            ],
            [
                'name' => 'Creative Video Competition',
                'slug' => 'creative-video',
                'description' => 'Kompetisi video kreatif yang merepresentasikan potensi agroindustri.',
                'type' => 'team',
                'price' => 50000,
                'max_member' => 5,
            ],
            [
                'name' => 'Lomba Karya Tulis Ilmiah (LKTI) Nasional',
                'slug' => 'lkti-nasional',
                'description' => 'Wadah inovasi mahasiswa dalam bentuk karya tulis ilmiah nasional.',
                'type' => 'team',
                'price' => 120000,
                'max_member' => 3,
            ],
        ];

        foreach ($competitionsData as $data) {
            $comp = Competitions::create($data);

            // Create a Juri for each competition
            $juriName = "Juri " . explode(' ', $comp->name)[0];
            $juriEmail = strtolower(explode(' ', $comp->name)[0]) . "@agridation.com";

            $juri = User::create([
                'name' => $juriName,
                'email' => $juriEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => $now,
            ]);
            $juri->assignRole('juri');

            Judges::create([
                'user_id' => $juri->id,
                'competition_id' => $comp->id,
            ]);
        }

        // 3. Create a dummy Peserta
        $peserta = User::create([
            'name' => 'Peserta Satu',
            'email' => 'peserta@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
        ]);
        $peserta->assignRole('peserta');
        
        $peserta->profile()->create([
            'status' => 'pending',
            'nim' => 'F12345678',
            'birth_date' => '2004-05-21',
            'phone' => '081234567890',
            'instagram' => '@peserta_satu',
            'institution' => 'IPB University',
        ]);
    }
}
