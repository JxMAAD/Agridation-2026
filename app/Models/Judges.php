<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'competition_id'])]
class Judges extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function scores()
    {
        return $this->hasMany(Scores::class);
    }
}
