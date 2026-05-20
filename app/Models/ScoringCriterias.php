<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'title', 'max_score', 'weight'])]
class ScoringCriterias extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function scores()
    {
        return $this->hasMany(Scores::class);
    }
}
