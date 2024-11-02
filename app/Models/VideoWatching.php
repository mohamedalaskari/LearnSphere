<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class VideoWatching extends Model
{
    protected $fillable=[
      'user_id',
      'video_id',
      'count',
      'last_watch',
      'created_at'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    use HasFactory,SoftDeletes,HasApiTokens;
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
