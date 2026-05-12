<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domain extends Model
{
    protected $fillable = ['name', 'color', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function concepts(): HasMany
    {
        return $this->hasMany(Concept::class);
    }

    public function masteredConcepts(): HasMany
    {
        return $this->hasMany(Concept::class)->where('status', 'mastered');
    }

    public function toReviewConcepts(): HasMany
    {
        return $this->hasMany(Concept::class)->where('status', 'to_review');
    }

    public function inProgressConcepts(): HasMany
    {
        return $this->hasMany(Concept::class)->where('status', 'in_progress');
    }
}