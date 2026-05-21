<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'titel', 'content', 'order'])]
class CompetitionRules extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }
}
