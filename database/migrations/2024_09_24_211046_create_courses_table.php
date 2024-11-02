<?php

use App\Models\Subject;
use App\Models\Teacher;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->float('price');
            $table->float('discount')->nullable();
            $table->integer('number_of_videos')->nullable();
            $table->text('bio')->nullable();
            $table->foreignIdFor(Subject::class)->constrained();
            $table->foreignIdFor(Teacher::class)->constrained();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
