<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'google_id'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    // PROFILE
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // DOCUMENTS
    public function documents()
    {
        return $this->hasOne(UserDocument::class);
    }

    // VERIFIED DOCUMENTS
    public function verifiedDocuments()
    {
        return $this->hasMany(UserDocument::class, 'verified_by');
    }

    // TEAM LEADER
    public function teams()
    {
        return $this->hasMany(Teams::class, 'leader_id');
    }

    // ANNOUNCEMENTS CREATED
    public function announcements()
    {
        return $this->hasMany(Announcements::class, 'created_by');
    }

    // JUDGE
    public function judges()
    {
        return $this->hasMany(Judges::class);
    }

    // DEBATE MOTIONS CREATED
    public function debateMotions()
    {
        return $this->hasMany(DebateMotions::class, 'created_by');
    }

    // NOTIFICATIONS RECEIVED
    public function notifications()
    {
        return $this->hasMany(Notifications::class);
    }

    // NOTIFICATIONS SENT
    public function sentNotifications()
    {
        return $this->hasMany(Notifications::class, 'sender_id');
    }
}
