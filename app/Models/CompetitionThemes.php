<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'titel', 'description'])]
class CompetitionThemes extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }
}
