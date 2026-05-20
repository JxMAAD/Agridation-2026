<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['competition_id', 'created_by', 'title', 'slug', 'description', 'round', 'is_published', 'released_at'])]
class DebateMotions extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($motion) {

            // generate slug otomatis
            $slug = Str::slug($motion->title);

            // cek duplicate slug
            $count = self::where('slug', 'LIKE', "{$slug}%")->count();

            $motion->slug = $count
                ? "{$slug}-" . ($count + 1)
                : $slug;
        });

        static::updating(function ($motion) {

            // update slug jika title berubah
            if ($motion->isDirty('title')) {

                $slug = Str::slug($motion->title);

                $count = self::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $motion->id)
                    ->count();

                $motion->slug = $count
                    ? "{$slug}-" . ($count + 1)
                    : $slug;
            }
        });
    }

    protected $casts = [
        'is_published' => 'boolean',
        'released_at' => 'datetime',
    ];

    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function matchups()
    {
        return $this->hasMany(DebateMatchups::class, 'motion_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
