<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'category',
        'location',
        'link',
        'tags',
        'likes_count'
    ];

    protected $casts = [
        'tags' => 'array',
        'likes_count' => 'integer'
    ];

    /**
     * Les utilisateurs qui ont liké cette photo
     */
    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'picture_likes')
                    ->withTimestamps();
    }

    /**
     * Vérifier si une photo est likée par un utilisateur
     */
    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }

    /**
     * Obtenir le nombre de likes
     */
    public function getLikesCountAttribute($value): int
    {
        return (int) $value;
    }

    /**
     * Scope pour les photos les plus likées
     */
    public function scopeMostLiked($query)
    {
        return $query->orderBy('likes_count', 'desc');
    }

    /**
     * Scope pour les photos récentes
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}