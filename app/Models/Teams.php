<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'leader_id', 'team_name', 'is_finalized', 'status'])]
class Teams extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members()
    {
        return $this->hasMany(TeamMembers::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submissions::class);
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedules::class);
    }

    public function teamAMatchups()
    {
        return $this->hasMany(DebateMatchups::class, 'team_a_id');
    }

    public function teamBMatchups()
    {
        return $this->hasMany(DebateMatchups::class, 'team_b_id');
    }
}
