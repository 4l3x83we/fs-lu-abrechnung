<?php

use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auftrag\AuftragsberechnungController;
use App\Http\Controllers\Maps\MapsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Project\MarktpreiseController;
use App\Http\Controllers\Project\NotesController;
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

    Route::resource('/project', ProjectsController::class)->only('index');
    Route::get('/project/change/{projectID}', [ProjectsController::class, 'changeProject'])->name('projects.change');

    Route::prefix('project')->name('project.')->middleware('can:project_member')->group(function () {
        Route::resource('/notes', NotesController::class);
        Route::prefix('auftragsberechnung')->name('auftragsberechnung.')->group(function () {
            Route::get('/', [AuftragsberechnungController::class, 'auftrag'])->name('auftrag');
        });
        Route::prefix('marktpreise')->name('marktpreise.')->group(function () {
            Route::get('/', [MarktpreiseController::class, 'feldfruechte'])->name('feldfruechte');
        });
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::prefix('admin')->name('admin.')->middleware('can:manage_users')->group(function () {
            Route::resource('users', UserController::class)->only('index', 'store');
            Route::resource('maps', MapsController::class)->only('index', 'create');
        });
    });
});

Route::get('invitations/{token}', [UserController::class, 'acceptInvitation'])->name('invitations.accept');

require __DIR__.'/auth.php';
