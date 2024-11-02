<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TeacherController;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('classroom',[ClassroomController::class,'index']);
// Route::get('teachers/deleted',[TeacherController::class,'deleted']);
