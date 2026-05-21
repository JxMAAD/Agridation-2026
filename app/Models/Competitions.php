<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['name', 'slug', 'description', 'type', 'price', 'max_member', 'guidebook', 'thumbnail', 'is_active'])]
class Competitions extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($competition) {

            // generate slug otomatis
            $slug = Str::slug($competition->name);

            // cek duplicate slug
            $count = self::where('slug', 'LIKE', "{$slug}%")->count();

            $competition->slug = $count
                ? "{$slug}-" . ($count + 1)
                : $slug;
        });

        static::updating(function ($competition) {

            // update slug jika name berubah
            if ($competition->isDirty('name')) {

                $slug = Str::slug($competition->name);

                $count = self::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $competition->id)
                    ->count();

                $competition->slug = $count
                    ? "{$slug}-" . ($count + 1)
                    : $slug;
            }
        });

        static::saving(function ($competition) {

            $competition->code = strtoupper($competition->code);
        });
    }

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function themes()
    {
        return $this->hasMany(CompetitionThemes::class);
    }

    public function timelines()
    {
        return $this->hasMany(Timelines::class);
    }

    public function rules()
    {
        return $this->hasMany(CompetitionRules::class);
    }

    public function submissionStages()
    {
        return $this->hasMany(SubmissionStages::class);
    }

    public function teams()
    {
        return $this->hasMany(Teams::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcements::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedules::class);
    }

    public function scoringCriterias()
    {
        return $this->hasMany(ScoringCriterias::class);
    }

    public function judges()
    {
        return $this->hasMany(Judges::class);
    }

    public function debateMotions()
    {
        return $this->hasMany(DebateMotions::class);
    }

    public function debateMatchups()
    {
        return $this->hasMany(DebateMatchups::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
