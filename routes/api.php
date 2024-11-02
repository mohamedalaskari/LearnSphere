<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoWatchingController;
use App\Http\Controllers\WishlistController;
use App\Models\Subject;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//test_stripe

//login
//Route::get('Verification_Email', [AuthController::class, 'Verification'])->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('logout_all',  [AuthController::class, 'logout_all'])->middleware('auth:sanctum');
Route::post('forgot_password', [AuthController::class, 'forgot_password']);
Route::post('reset_password', [AuthController::class, 'reset_password'])->name('password.reset');

//classroom
Route::prefix('classrooms')->group(function () {
    Route::get('/deleted', [ClassroomController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [ClassroomController::class, 'index']);
    Route::get('/{classroom}', [ClassroomController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [ClassroomController::class, 'store'])->middleware('auth:sanctum');
    Route::patch('/update', [ClassroomController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('delete/{classroom}', [ClassroomController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('restore/{classroom}', [ClassroomController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{classroom}', [ClassroomController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//Wishlist
Route::prefix('wishlists')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/add', [WishlistController::class, 'store'])->middleware('auth:sanctum');
    Route::delete('delete/{wishlist}', [WishlistController::class, 'delete'])->middleware('auth:sanctum');
});
//courses
Route::prefix('courses')->group(function () {
    Route::get('deleted', [CourseController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [CourseController::class, 'index'])->middleware('auth:sanctum');
    Route::get('restore/{course}', [CourseController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/{course}', [CourseController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [CourseController::class, 'store'])->middleware('auth:sanctum');
    Route::patch('/update', [CourseController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('delete/{course}', [CourseController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{course}', [CourseController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//subject
Route::prefix('subjects')->group(function () {
    Route::get('/deleted', [SubjectController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [SubjectController::class, 'index']);
    Route::get('/{subject}', [SubjectController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [SubjectController::class, 'store'])->middleware('auth:sanctum');
    Route::patch('/update', [SubjectController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('delete/{subject}', [SubjectController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('restore/{subject}', [SubjectController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{subject}', [SubjectController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//user
Route::prefix('users')->group(function () {
    Route::get('/deleted', [UserController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('restore/{user}', [UserController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/MyProfile', [UserController::class, 'MyProfile'])->middleware('auth:sanctum');
    Route::get('/', [UserController::class, 'index'])->middleware('auth:sanctum');
    Route::patch('/update', [UserController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/add', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show'])->middleware('auth:sanctum');
    Route::get('delete/{user}', [UserController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{user}', [UserController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//governorate
Route::prefix('governorates')->group(function () {
    Route::get('deleted', [GovernorateController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [GovernorateController::class, 'index']);
    Route::get('/{governorate}', [GovernorateController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [GovernorateController::class, 'store'])->middleware('auth:sanctum');
    Route::patch('/update', [GovernorateController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('delete/{governorate}', [GovernorateController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('restore/{governorate}', [GovernorateController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{governorate}', [GovernorateController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//payment
Route::prefix('payments')->group(function () {
    Route::get('deleted', [PaymentController::class, 'deleted'])->middleware('auth:sanctum');
    Route::post('pay',   [PaymentController::class, 'pay'])->middleware('auth:sanctum');
    Route::get('/', [PaymentController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{payment}', [PaymentController::class, 'show'])->middleware('auth:sanctum');
    Route::post('add', [PaymentController::class, 'store'])->middleware('auth:sanctum')->name('success');
    Route::post('cancel', [PaymentController::class, 'cancel'])->middleware('auth:sanctum')->name('cancel');
    Route::patch('/update', [PaymentController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/delete/{payment}', [PaymentController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/restore/{payment}', [PaymentController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{payment}', [PaymentController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});;
//teacher
Route::prefix('teachers')->group(function () {
    Route::get('/deleted', [TeacherController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [TeacherController::class, 'index']);
    Route::get('/{teacher}', [TeacherController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [TeacherController::class, 'store'])->middleware('auth:sanctum');
    Route::patch('/update', [TeacherController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/delete/{teacher}', [TeacherController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/restore/{teacher}', [TeacherController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{teacher}', [TeacherController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//video
Route::prefix('videos')->group(function () {
    Route::get('deleted', [VideoController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [VideoController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{video}', [VideoController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/add', [VideoController::class, 'store'])->middleware('auth:sanctum');
    Route::patch('/update', action: [VideoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/delete/{video}', [VideoController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/restore/{video}', [VideoController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{video}', [VideoController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});
//VideoWatching
Route::prefix('VideoWatchings')->group(function () {
    Route::get('deleted', [VideoWatchingController::class, 'deleted'])->middleware('auth:sanctum');
    Route::post('/add', [VideoWatchingController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/', [VideoWatchingController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{videoWatching}', [VideoWatchingController::class, 'show'])->middleware('auth:sanctum');
    Route::get('/delete/{videoWatching}', [VideoWatchingController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('/restore/{videoWatching}', [VideoWatchingController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/delete_from_trash/{videoWatching}', [VideoWatchingController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});