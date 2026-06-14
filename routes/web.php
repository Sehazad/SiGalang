<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// ─── Auth Routes (Guest only) ──────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    // User (Customer) Login & Register
    Route::get('login',    [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',   [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register',[AuthController::class, 'register']);

    // Admin Login & Register (khusus admin & karyawan)
    Route::get('admin/login',  [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.process');
    Route::get('admin/register',  [AuthController::class, 'showAdminRegisterForm'])->name('admin.register');
    Route::post('admin/register', [AuthController::class, 'adminRegister'])->name('admin.register.process');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ─── Protected Routes (Auth required) ─────────────────────────────────────
Route::middleware('auth')->group(function () {

    // ── Booking ─────────────────────────────────────────────────────────────
    Route::get('/booking/create',  [\App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store',  [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/jadwal',  [\App\Http\Controllers\BookingController::class, 'getJadwalTersedia'])->name('booking.jadwal');

    // ── Turnamen ────────────────────────────────────────────────────────────
    Route::get('/turnamen/create',        [\App\Http\Controllers\TurnamenController::class, 'create'])->name('turnamen.create');
    Route::post('/turnamen/store',        [\App\Http\Controllers\TurnamenController::class, 'store'])->name('turnamen.store');
    Route::get('/turnamen/{id}/bagan',    [\App\Http\Controllers\TurnamenController::class, 'bagan'])->name('turnamen.bagan');

    // ── Payment ─────────────────────────────────────────────────────────────
    Route::get('/payment/simulasi',  [\App\Http\Controllers\PaymentController::class, 'simulasi'])->name('payment.simulasi');
    Route::post('/payment/process',  [\App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');

    // ── Tiket ───────────────────────────────────────────────────────────────
    Route::get('/tiket-saya', [\App\Http\Controllers\TiketController::class, 'tiketSaya'])->name('tiket.saya');
    Route::get('/tiket/{id}', [\App\Http\Controllers\TiketController::class, 'show'])->name('tiket.show');

    // ── Admin Routes ─────────────────────────────────────────────────────────
    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Kelola Booking
        Route::get('/admin/bookings',                  [\App\Http\Controllers\AdminController::class, 'bookingsIndex'])->name('admin.bookings.index');
        Route::post('/admin/bookings/{id}/confirm',    [\App\Http\Controllers\AdminController::class, 'confirmBooking'])->name('admin.bookings.confirm');
        Route::post('/admin/bookings/{id}/cancel',     [\App\Http\Controllers\AdminController::class, 'cancelBooking'])->name('admin.bookings.cancel');

        // Turnamen
        Route::get('/admin/turnamen',                          [\App\Http\Controllers\AdminController::class, 'turnamenIndex'])->name('admin.turnamen.index');
        Route::post('/admin/turnamen/{id}/generate',           [\App\Http\Controllers\AdminController::class, 'generateBracket'])->name('admin.turnamen.generate');
        Route::post('/admin/turnamen/{id}/confirm-payment',    [\App\Http\Controllers\AdminController::class, 'confirmTournamentPayment'])->name('admin.turnamen.confirm_payment');
        Route::post('/admin/turnamen/{id}/reject',             [\App\Http\Controllers\AdminController::class, 'rejectTournament'])->name('admin.turnamen.reject');

        // Check-in
        Route::get('/admin/checkin',  [\App\Http\Controllers\AdminController::class, 'checkinIndex'])->name('admin.checkin');
        Route::post('/admin/checkin', [\App\Http\Controllers\AdminController::class, 'processCheckin'])->name('admin.checkin.process');

        // Kelola User
        Route::get('/admin/users',             [\App\Http\Controllers\AdminController::class, 'usersIndex'])->name('admin.users.index');
        Route::post('/admin/users/create',     [\App\Http\Controllers\AdminController::class, 'usersCreate'])->name('admin.users.create');
        Route::post('/admin/users/{id}/edit',  [\App\Http\Controllers\AdminController::class, 'usersUpdate'])->name('admin.users.update');
        Route::post('/admin/users/{id}/delete',[\App\Http\Controllers\AdminController::class, 'usersDelete'])->name('admin.users.delete');
    });
});

