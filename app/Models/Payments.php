<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['team_id', 'invoice_number', 'amount', 'proof_file', 'sender_name', 'payment_method', 'sender_note', 'status', 'verification_note', 'verified_by', 'verified_at', 'paid_at'])]
class Payments extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {

            // ambil competition
            $competition = $payment->team->competition;

            // code lomba dari database
            $competitionCode = $competition->code;

            // hitung invoice berdasarkan lomba
            $count = self::whereHas('team', function ($query) use ($competition) {

                $query->where('competition_id', $competition->id);

            })->count() + 1;

            // generate invoice
            $payment->invoice_number =
                'AGR-' .
                now()->format('Y') . '-' .
                strtoupper($competitionCode) .
                str_pad($count, 3, '0', STR_PAD_LEFT);
        });
    }

    protected $casts = [
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Teams::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
