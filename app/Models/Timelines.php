<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['competition_id', 'title', 'description', 'start_date', 'end_date', 'order'])]
class Timelines extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }
}
