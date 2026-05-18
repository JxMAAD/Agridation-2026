<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            // kode invoice pembayaran
            $table->string('invoice_number')->unique();
            $table->decimal('amount', 12, 2);
            // bukti transfer upload peserta
            $table->string('proof_file');
            // nama pengirim rekening/e-wallet
            $table->string('sender_name')->nullable();
            // bank / ewallet
            $table->string('payment_method')->nullable();
            // catatan peserta
            $table->text('sender_note')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // catatan admin
            $table->text('verification_note')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            // waktu verifikasi
            $table->timestamp('verified_at')->nullable();
            // waktu upload pembayaran
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
