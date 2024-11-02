<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'Classroom_id',
        'governorate_id',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'deleted_at',
        'role',
        'email_verified_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function videowatching(): HasMany
    {
        return $this->hasMany(VideoWatching::class);
    }
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }
    protected function role(): Attribute
    {
        return Attribute::make(
            get: fn($val) => explode(',', $val),
            set: fn($val) => implode(',', $val)
        );
    }
}
