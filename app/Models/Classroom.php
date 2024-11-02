<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Classroom extends Model
{

    use HasFactory, SoftDeletes,HasApiTokens;
    protected $fillable = [
        'classroom',
        'created_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }


}
