<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['team_id', 'submission_stage_id', 'title', 'description', 'file', 'thumbnail', 'external_link', 'status', 'submitted_at'])]
class Submissions extends Model
{
    public function team()
    {
        return $this->belongsTo(Teams::class);
    }

    public function submissionStage()
    {
        return $this->belongsTo(SubmissionStages::class);
    }

    public function scores()
    {
        return $this->hasMany(Scores::class);
    }
}
