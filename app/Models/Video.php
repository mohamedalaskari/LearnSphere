<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Video extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'teacher_id',
        'course_id',
        'subject_id',
        'video_url',
        'name_video',
        'created_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    public function videowatching(): HasMany
    {
        return $this->hasMany(VideoWatching::class);
    }
}
