<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Payment extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'amount',
        'user_id',
        'course_id',
        'created_at',
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);

    }
    public function course(): BelongsTo
    {
        return $this->BelongsTo(Course::class);

    }

}
