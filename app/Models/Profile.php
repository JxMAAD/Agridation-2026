<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'nim', 'birth_date', 'phone', 'instagram', 'institution', 'faculty', 'major', 'status', 'photo_profile'])]
class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
