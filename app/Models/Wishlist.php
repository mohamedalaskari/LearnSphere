<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Wishlist extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes;
    protected $fillable = [
        'user_id',
        'course_id',
        'created_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    public function course(): BelongsTo
    {
        return $this->BelongsTo(Course::class);
    }
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
