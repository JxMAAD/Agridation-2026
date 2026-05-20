<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['competition_id', 'name', 'slug', 'description', 'order', 'is_paid_stage', 'is_active', 'deadline'])]
class SubmissionStages extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stage) {

            $slug = Str::slug($stage->name);

            // unik per competition
            $count = self::where('competition_id', $stage->competition_id)
                ->where('slug', 'LIKE', "{$slug}%")
                ->count();

            $stage->slug = $count
                ? "{$slug}-" . ($count + 1)
                : $slug;
        });

        static::updating(function ($stage) {

            if ($stage->isDirty('name')) {

                $slug = Str::slug($stage->name);

                $count = self::where('competition_id', $stage->competition_id)
                    ->where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $stage->id)
                    ->count();

                $stage->slug = $count
                    ? "{$slug}-" . ($count + 1)
                    : $slug;
            }
        });
    }

    protected $casts = [
        'is_paid_stage' => 'boolean',
        'is_active' => 'boolean',
        'deadline' => 'datetime',
    ];

    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submissions::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
