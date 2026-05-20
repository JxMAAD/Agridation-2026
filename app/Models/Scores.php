<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['judge_id', 'submission_id', 'scoring_criteria_id', 'score', 'feedback'])]
class Scores extends Model
{
    public function judge()
    {
        return $this->belongsTo(Judges::class);
    }

    public function submission()
    {
        return $this->belongsTo(Submissions::class);
    }

    public function scoringCriteria()
    {
        return $this->belongsTo(ScoringCriterias::class);
    }
}
