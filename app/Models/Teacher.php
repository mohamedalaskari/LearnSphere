<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
 use HasFactory,SoftDeletes,HasApiTokens,Notifiable;

    protected $fillable = [
        'image',
        'first_name',
        'last_name',
        'email',
        'phone',
        'bio',
        'governorate_id',
        'created_at',
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }
    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }
}
