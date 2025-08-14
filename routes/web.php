<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Functions;
use App\Http\Controllers\CalendlyOauthController;
use App\Http\Controllers\PesapalPaymentController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use App\Models\Booking;

Route::get('/', function () {
    return view('home', ['services' => Functions::getServices(), 'testimonials' => Functions::getTestimonials()]);
})->name('home');

Route::get('/home', function () {
    return view('home', ['services' => Functions::getServices(), 'testimonials' => Functions::getTestimonials()]);
})->name('landing');

Route::resource('blog', \App\Http\Controllers\BlogController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'blog',
        'show' => 'blog.show'
    ]);

Route::get('/bookings', [BookingController::class, 'getSessions'])->middleware(['auth', 'verified'])->name('bookings.list');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/calendly/authorize', [CalendlyOAuthController::class, 'redirectToCalendly']);
Route::get('/calendly/callback', [CalendlyOAuthController::class, 'handleCallback']);
Route::get('/calendly/events', [CalendlyOAuthController::class, 'showEvents']);
Route::get('/book-session', [CalendlyOAuthController::class, 'showBookingPage'])->name('bookSession');

Route::get('/pay/{booking}', [PesapalPaymentController::class, 'initiatePayment'])->name('pesapal.pay');
Route::post('/pay/{booking}/checkout', [PesapalPaymentController::class, 'checkout'])->name('pesapal.checkout');
Route::get('/pesapal/callback', [PesapalPaymentController::class, 'handleCallback'])->name('pesapal.callback');


Route::get('/booking/confirmed/{booking}', function (\App\Models\Booking $booking) {
    return view('booking.confirmed', compact('booking'));
})->name('booking.confirmed');

Route::get('/api/booking-id', function (Request $request) {
    $email = $request->query('email');
    $booking = Booking::where('email', $email)->latest()->first();
    return ['booking_id' => $booking ? $booking->id : null];
});

Route::get('/api/latest-booking', function () {
    $booking = Booking::latest()->first();
    return ['booking_id' => $booking ? $booking->id : null];
});

Route::get('/api/booking-by-event', function (Request $request) {
    $event_id = $request->query('event_id');
    $booking = Booking::where('calendly_event_id', $event_id)->latest()->first();
    return ['booking_id' => $booking ? $booking->id : null];
});

Route::get('/booking/fetch-latest', [App\Http\Controllers\BookingController::class, 'fetchLatest']);

require __DIR__ . '/auth.php';

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('blogs', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blogs.index');
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class)
        ->except(['index', 'show'])
        ->names('admin.blogs');
});
