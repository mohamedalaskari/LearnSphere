<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_watchings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Video::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->integer('count')->default(0);
            $table->date('last_watch')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_watchings');
    }
};
