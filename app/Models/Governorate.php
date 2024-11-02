<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Governorate extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable =[
        'governorate',
        'created_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    public function teacher(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
