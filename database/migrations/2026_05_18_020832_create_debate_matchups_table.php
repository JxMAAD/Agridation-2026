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
        Schema::create('debate_matchups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motion_id')->nullable()->constrained('debate_motions')->nullOnDelete();
            $table->foreignId('team_a_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('team_b_id')->constrained('teams')->cascadeOnDelete();
            $table->enum('round', ['preliminary', 'quarter_final', 'semi_final', 'grand_final']);
            $table->enum('winner_side', ['team_a', 'team_b'])->nullable();
            $table->dateTime('match_time')->nullable();
            $table->string('zoom_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debate_matchups');
    }
};
