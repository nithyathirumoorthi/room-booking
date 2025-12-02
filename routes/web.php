<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

use App\Http\Middleware\AdminMiddleware;

// --------------------
// Public Routes
// --------------------

// Redirect root to rooms
Route::get('/', fn() => redirect()->route('rooms.index'));

// List all available rooms
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

// Show single room details (optional)
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
// Show booking form for a room
Route::get('/book/{room}', [BookingController::class, 'create'])->name('book.room');

// Store booking
Route::post('/book/{room}', [BookingController::class, 'store'])->name('book.store');
// Stripe payment callback
Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
// --------------------
// User Booking Routes (authenticated)
// --------------------
Route::middleware(['auth'])->group(function () {
    // User bookings list
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

});


Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    // Admin dashboard
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');

    // CRUD for rooms
    Route::resource('rooms', AdminRoomController::class);

    // View all bookings
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    // Route to update booking status
    Route::post('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
});

// --------------------
// Auth & Profile Routes
// --------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
});
// Admin dashboard
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
});

// User dashboard (after login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return redirect()->route('rooms.index'); // redirect user to rooms list
    })->name('dashboard');
});


require __DIR__.'/auth.php';
