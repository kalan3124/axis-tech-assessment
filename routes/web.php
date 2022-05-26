<?php

use App\Http\Livewire\Course\CourseView;
use App\Http\Livewire\UserCourse\UserCourseView;
use App\Http\Livewire\Users\UserDetails;
use App\Http\Livewire\Users\UserView;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/users', UserView::class)->name('users.view');
    Route::get('/user/details/{id}', UserDetails::class)->name('user.details');

    Route::get('/courses', CourseView::class)->name('courses.view');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/user/courses/view', UserCourseView::class)->name('user.courses.view');
});

require __DIR__ . '/auth.php';
