<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }

    /**
     * Les photos que l'utilisateur a likées
     */
    public function likedPictures(): BelongsToMany
    {
        return $this->belongsToMany(Picture::class, 'picture_likes')
                    ->withTimestamps();
    }

    /**
     * Vérifier si l'utilisateur a liké une photo
     */
    public function hasLiked(Picture $picture): bool
    {
        return $this->likedPictures()->where('picture_id', $picture->id)->exists();
    }

    /**
     * Liker une photo
     */
    public function likePicture(Picture $picture): bool
    {
        if (!$this->hasLiked($picture)) {
            $this->likedPictures()->attach($picture->id);
            $picture->increment('likes_count');
            return true;
        }
        return false;
    }

    /**
     * Unliker une photo
     */
    public function unlikePicture(Picture $picture): bool
    {
        if ($this->hasLiked($picture)) {
            $this->likedPictures()->detach($picture->id);
            $picture->decrement('likes_count');
            return true;
        }
        return false;
    }

    /**
     * Obtenir le nom complet
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }
}