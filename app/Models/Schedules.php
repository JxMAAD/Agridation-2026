<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'team_id', 'title', 'description', 'start_time', 'end_time', 'location', 'zoom_link'])]
class Schedules extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function team()
    {
        return $this->belongsTo(Teams::class);
    }
}
