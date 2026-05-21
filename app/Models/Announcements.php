<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['competition_id', 'created_by', 'title', 'slug', 'thumbnail', 'content', 'status', 'published_at'])]
class Announcements extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($announcement) {

            // generate slug otomatis
            $slug = Str::slug($announcement->title);

            // cek slug duplicate
            $count = self::where('slug', 'LIKE', "{$slug}%")->count();

            $announcement->slug = $count
                ? "{$slug}-" . ($count + 1)
                : $slug;
        });

        static::updating(function ($announcement) {

            // update slug jika title berubah
            if ($announcement->isDirty('title')) {

                $slug = Str::slug($announcement->title);

                $count = self::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $announcement->id)
                    ->count();

                $announcement->slug = $count
                    ? "{$slug}-" . ($count + 1)
                    : $slug;
            }
        });
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function competition()
    {
        return $this->belongsTo(Competitions::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
