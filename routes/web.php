<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
    'competitions' => [
        [
            'id' => 'bpc',
            'name' => 'Business Plan Competition (BPC)',
            'description' => 'Fokus inovasi agroindustri (pengolahan, rantai pasok, circular economy).',
            'slug' => 'business-plan-competition'
        ],
        [
            'id' => 'debate',
            'name' => 'Debate (Debat Pertanian Nasional)',
            'description' => 'Sistem Asian Parliamentary Debate merespons mosi agroindustri.',
            'slug' => 'debate'
        ],
        [
            'id' => 'infografis',
            'name' => 'Infografis Competition',
            'description' => 'Lomba desain visual edukatif dengan tema agroindustri.',
            'slug' => 'infografis'
        ],
        [
            'id' => 'video',
            'name' => 'Creative Video Competition',
            'description' => 'Kompetisi video kreatif yang merepresentasikan potensi agroindustri.',
            'slug' => 'creative-video'
        ],
        [
            'id' => 'lkti',
            'name' => 'Lomba Karya Tulis Ilmiah (LKTI) Nasional',
            'description' => 'Wadah inovasi mahasiswa dalam bentuk karya tulis ilmiah nasional.',
            'slug' => 'lkti-nasional'
        ],
    ]
])->name('home');

Route::get('/{slug}', function ($slug) {
    $competitions = [
        'business-plan-competition' => [
            'id' => 'bpc',
            'name' => 'Business Plan Competition (BPC)',
            'description' => 'Fokus inovasi agroindustri (pengolahan, rantai pasok, circular economy).',
            'themes' => ['Pangan', 'Teknologi Infrastruktur', 'Ekonomi Inklusif', 'Produksi Berkelanjutan'],
            'timeline' => [
                ['event' => 'Pendaftaran & Pengumpulan BMC (Gate 1)', 'date' => '1 Juli - 15 Agustus 2026'],
                ['event' => 'Pengumuman Lolos Tahap 1', 'date' => '20 Agustus 2026'],
                ['event' => 'Pengumpulan Proposal & Video (Gate 2)', 'date' => '21 Agustus - 10 September 2026'],
                ['event' => 'Final Presentation (Gate 3)', 'date' => '24 September 2026'],
            ],
            'rules' => [
                'Satu tim terdiri dari maksimal 3 orang mahasiswa.',
                'Karya harus orisinal dan belum pernah memenangkan kompetisi serupa.',
                'Sistematika BMC mengacu pada model 9+1 Elemen.',
                'Proposal maksimal 15 halaman (tidak termasuk lampiran).',
            ],
            'guidebook_url' => '#',
        ],
        'debate' => [
            'id' => 'debate',
            'name' => 'Debate (Debat Pertanian Nasional)',
            'description' => 'Sistem Asian Parliamentary Debate merespons mosi agroindustri.',
            'themes' => ['Hilirisasi Pertanian', 'Mekanisasi Pertanian', 'Subsidi Pupuk', 'Kesejahteraan Petani'],
            'timeline' => [
                ['event' => 'Pendaftaran Tim', 'date' => '1 Juli - 30 Agustus 2026'],
                ['event' => 'Technical Meeting', 'date' => '5 September 2026'],
                ['event' => 'Babak Penyisihan & Quarter-Final', 'date' => '15 September 2026'],
                ['event' => 'Semi-Final & Grand Final', 'date' => '24 September 2026'],
            ],
            'rules' => [
                'Satu tim terdiri dari 3 pembicara.',
                'Menggunakan sistem Asian Parliamentary Debate.',
                'Mosi akan diberikan sebelum pertandingan (Impulse Motion) atau sudah disiapkan sebelumnya.',
            ],
            'guidebook_url' => '#',
        ],
        'infografis' => [
            'id' => 'infografis',
            'name' => 'Infografis Competition',
            'description' => 'Lomba desain visual edukatif dengan tema agroindustri.',
            'themes' => ['Modernisasi Agroindustri', 'Digitalisasi Pertanian', 'Keamanan Pangan Nasional'],
            'timeline' => [
                ['event' => 'Pendaftaran & Pengumpulan Karya', 'date' => '1 Juli - 10 September 2026'],
                ['event' => 'Penilaian Juri & Voting Juara Favorit', 'date' => '15 - 20 September 2026'],
                ['event' => 'Pengumuman Pemenang', 'date' => '24 September 2026'],
            ],
            'rules' => [
                'Format karya berupa PNG/JPG dengan resolusi minimal 300dpi.',
                'Karya bersifat orisinal dan tidak mengandung unsur SARA.',
                'Wajib mengunggah karya di Instagram pribadi dengan tag akun Agridation.',
            ],
            'guidebook_url' => '#',
        ],
        'creative-video' => [
            'id' => 'creative-video',
            'name' => 'Creative Video Competition',
            'description' => 'Kompetisi video kreatif yang merepresentasikan potensi agroindustri.',
            'themes' => ['Profil Agroindustri Lokal', 'Inovasi Produk Pertanian', 'Smart Farming di Indonesia'],
            'timeline' => [
                ['event' => 'Pendaftaran & Pengumpulan Teaser', 'date' => '1 Juli - 15 Agustus 2026'],
                ['event' => 'Pengumpulan Video Full', 'date' => '16 Agustus - 15 September 2026'],
                ['event' => 'Pemutaran Karya Nominasi Terbaik', 'date' => '24 September 2026'],
            ],
            'rules' => [
                'Resolusi video minimal 1080p (Full HD).',
                'Durasi video maksimal 5 menit.',
                'Tidak mengandung unsur SARA, kekerasan, atau pornografi.',
            ],
            'guidebook_url' => '#',
        ],
        'lkti-nasional' => [
            'id' => 'lkti',
            'name' => 'Lomba Karya Tulis Ilmiah (LKTI) Nasional',
            'description' => 'Wadah inovasi mahasiswa dalam bentuk karya tulis ilmiah nasional.',
            'themes' => ['Inovasi Teknologi Pangan', 'Sistem Distribusi Efisien', 'Ekonomi Sirkular di Agroindustri'],
            'timeline' => [
                ['event' => 'Pengumpulan Abstrak (Gate 1 - Gratis)', 'date' => '1 Juli - 31 Juli 2026'],
                ['event' => 'Pengumuman Lolos Abstrak', 'date' => '5 Agustus 2026'],
                ['event' => 'Pengumpulan Full Paper (Gate 2)', 'date' => '6 Agustus - 10 September 2026'],
                ['event' => 'Presentasi Final (Top 10)', 'date' => '24 September 2026'],
            ],
            'rules' => [
                'Format penulisan menggunakan Times New Roman 12pt.',
                'Karya harus orisinal dan didukung oleh data yang valid.',
                'Satu tim terdiri dari maksimal 3 orang mahasiswa.',
                'Format presentasi 10 menit materi + 15 menit tanya jawab.',
            ],
            'guidebook_url' => '#',
        ],
    ];

    if (!isset($competitions[$slug])) {
        abort(404);
    }

    return inertia('CompetitionDetail', [
        'competition' => $competitions[$slug],
        'canRegister' => Features::enabled(Features::registration()),
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
