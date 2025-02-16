<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'slug', 'content', 'order', 'course_id'
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function booted(): void
    {
        static::creating(function ($lesson) {
            if (empty($lesson->slug)) {
                $slug = Str::slug($lesson->title);
                $originaSlug = $slug;
                $count = 1;
                while (static::withTrashed()->where('slug', $slug)->exists()) {
                    $slug = $originaSlug . '-' . $count++;
                }
                $lesson->slug = $slug;
            }
        });
    }
}
