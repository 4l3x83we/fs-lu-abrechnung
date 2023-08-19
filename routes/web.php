<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/impressum', function () {
    return view('impressum');
})->name('impressum');
Route::get('/datenschutz', function () {
    return view('datenschutz');
})->name('datenschutz');
Route::get('/nutzungsbedienungen', function () {
    return view('nutzungsbedienungen');
})->name('nutzungsbedienungen');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/project', \App\Http\Controllers\Admin\ProjectsController::class)->only('index');
    Route::get('/project/change/{projectID}', [\App\Http\Controllers\Admin\ProjectsController::class, 'changeProject'])->name('projects.change');

    Route::prefix('project')->name('project.')->middleware('can:project_member')->group(function () {
        Route::resource('/notes', \App\Http\Controllers\Project\NotesController::class);
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only('index', 'store')->middleware('can:manage_users');
    });
});

Route::get('invitations/{token}', [\App\Http\Controllers\Admin\UserController::class, 'acceptInvitation'])->name('invitations.accept');

require __DIR__.'/auth.php';
