<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\BioskopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowTimeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmGenreController;
use App\Http\Controllers\FilmBioskopController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::get('/', [HomeController::class,
// 'films']{

// })->name('home');

Route::get('/', [HomeController::class, 'films'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('admin', [
        DashboardController::class,
        'index'
    ])->name('admin');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('studio', StudioController::class);
    Route::resource('showtime', ShowtimeController::class);
    Route::resource('film', FilmController::class);
    Route::resource('seat', SeatController::class);
    Route::resource('rating', RatingController::class);
    Route::resource('orderdetail', OrderDetailController::class);
    Route::resource('order', OrderController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('filmgenre', FilmGenreController::class);
    Route::resource('bioskop', BioskopController::class);
    Route::resource('filmbioskop', FilmBioskopController::class);
});



Route::get('/{slug}', [HomeController::class, 'show'])->name('film.show');

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
