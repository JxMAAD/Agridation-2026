<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'ktm_file', 'follow_proof', 'twibbon_proof', 'status', 'verification_note', 'verified_by', 'verified_at'])]
class UserDocument extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
