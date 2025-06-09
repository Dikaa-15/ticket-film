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
use App\Http\Controllers\SeatSelectionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserDashboardController;

// Route::get('/', [HomeController::class,
// 'films']{

// })->name('home');

Route::get('/', [HomeController::class, 'films'])->name('home');

Route::middleware(['auth', 'role:user,admin'])->group(function () {
    // Jadi misalnya ini
    Route::get('/films/{slug}', [HomeController::class, 'show'])->name('user.film.show');
    Route::get('/{slug}/showtime', [HomeController::class, 'showtime'])->name('film.showtime');
    Route::get('/showtime/{id}/seats', [SeatSelectionController::class, 'index'])->name('seat.selection');
    Route::post('/showtime/{id}/seats/book', [SeatSelectionController::class, 'book'])->name('seat.book');

    // routes for page films
    Route::get('/films', [HomeController::class, 'index'])->name('user.film.index');

    // Routes for confirm an order
    Route::post('/seat/confirm/{showtime}', [SeatController::class, 'confirmSeat'])->name('seat.confirm');
    Route::post('/seat/finalize', [OrderController::class, 'finalize'])->name('seat.finalize');
    //success order
    Route::get('/order-success/{order}', [OrderController::class, 'success'])
        ->middleware(['auth', 'role:user,admin', 'has.purchased.ticket'])
        ->name('order.success');

    // history order
    Route::get('/order-history', [OrderController::class, 'history'])->name('order.history');

    // contact-us
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
    
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
    Route::resource('seat', SeatController::class);
    Route::resource('rating', RatingController::class);
    Route::resource('orderdetail', OrderDetailController::class);
    Route::resource('order', OrderController::class);
    Route::patch('/order/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::resource('genre', GenreController::class);
    Route::resource('filmgenre', FilmGenreController::class);
    Route::resource('bioskop', BioskopController::class);
    Route::resource('filmbioskop', FilmBioskopController::class);

    // ADMIN CRUD FILM
    Route::get('/film', [FilmController::class, 'index'])->name('film.index');
    Route::get('/film/create', [FilmController::class, 'create'])->name('film.create');
    Route::post('/film', [FilmController::class, 'store'])->name('film.store');
    Route::get('/film/{film}', [FilmController::class, 'show'])->name('film.show');
    Route::get('/film/{film}/edit', [FilmController::class, 'edit'])->name('film.edit');
    Route::put('/film/{film}', [FilmController::class, 'update'])->name('film.update');
    Route::delete('/film/{film}', [FilmController::class, 'destroy'])->name('film.destroy');
});



Route::get('/tes-role', function () {
    return 'Halo! Kamu berhasil lolos middleware role!';
})->middleware(['auth', 'role:user,admin']);

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




Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
