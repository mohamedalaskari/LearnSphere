<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Subject extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable =[
        'subject',
        'created_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
