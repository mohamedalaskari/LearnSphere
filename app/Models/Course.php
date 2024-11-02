<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Course extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;
    protected $fillable = [
        'name',
        'image',
        'bio',
        'price',
        'discount',
        'number_of_videos',
        'subject_id',
        'teacher_id',
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
    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
