<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['team_id', 'name', 'nim', 'institution', 'faculty', 'major', 'phone', 'email'])]
class TeamMembers extends Model
{
    public function team()
    {
        return $this->belongsTo(Teams::class);
    }
}
