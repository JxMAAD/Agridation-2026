<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'motion_id', 'team_a_id', 'team_b_id', 'round', 'winner_side', 'match_tiem', 'zoom_link'])]
class DebateMatchups extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function motion()
    {
        return $this->belongsTo(DebateMotions::class, 'motion_id');
    }

    public function teamA()
    {
        return $this->belongsTo(Teams::class, 'team_a_id');
    }

    public function teamB()
    {
        return $this->belongsTo(Teams::class, 'team_b_id');
    }
}
