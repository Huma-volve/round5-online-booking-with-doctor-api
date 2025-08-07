<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\DoctorController;

use App\Http\Controllers\StripeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\API\Pages\PagesController;
use App\Http\Controllers\SearchHistoryController;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::get('/user', function (Request $request) {
    $user = $request->user();
    return [
        'user' => $user, // Spatie returns a collection of role names
    ];
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/doctors/{doctor}/available-slots', [AppointmentController::class, 'availableSlots']);
    Route::post('/appointments', [AppointmentController::class, 'book']);
    Route::get('/my-bookings', [AppointmentController::class, 'myBookings']);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel']);
    Route::post('/appointments/stripe-session', [StripeController::class, 'createStripeSession']);
    Route::get('/doctors/{doctor}/available-slots', [AppointmentController::class, 'availableSlots']);
    Route::post('/appointments', [AppointmentController::class, 'book']);
    Route::get('/my-bookings', [AppointmentController::class, 'myBookings']);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel']);
    Route::post('/stripe/webhook', [StripeController::class, 'handleWebhook']);
});


//public routes
Route::get('pages/{type}', [PagesController::class, 'show']);
Route::get('faqs', [FaqController::class, 'index']);
Route::get('faqs/{id}', [FaqController::class, 'show']);

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Password reset routes
Route::post('/send-reset-otp', [AuthController::class, 'sendResetOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Auth protected routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/profile', [AuthController::class, 'updateProfile']);

    Route::resource('cards', CardController::class);

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::resource('faqs', FaqController::class);
        Route::resource('pages', PagesController::class);
    });
});

Route::get('/webhook-handler', function () {
    // Run the deploy script
    $process = new Process(['/bin/bash', '/home/digital07/round5-online-booking-with-doctor-api.digital-vision-solutions.com/deploy.sh']);

    try {
        $process->mustRun(); // This will throw an exception if the command fails
    } catch (ProcessFailedException $exception) {
        return response('Deployment failed: ' . $exception->getMessage(), 500);
    }

    return response('Deployment completed successfully.', 200);
});


Route::get('doctors', [DoctorController::class, 'index']);
Route::get('doctors/{id}', [DoctorController::class, 'show']);
Route::get('specialities', [SpecialistController::class, 'index']);
Route::get('specialities/{id}', [SpecialistController::class, 'show']);
Route::get('doctors/search', [DoctorController::class, 'search']);
Route::get('searchHistories', [SearchHistoryController::class, 'searchHistory']);
Route::post('searchHistories', [SearchHistoryController::class, 'storeSearchHistory']);







Route::get('/webhook-handler', function () {
    $process = new Process(['/bin/bash', '/home/digital07/round5-online-booking-with-doctor-api.digital-vision-solutions.com/deploy.sh']);

    try {
        $process->mustRun();
    } catch (ProcessFailedException $exception) {
        return response('Deployment failed: ' . $exception->getMessage(), 500);
    }

    return response('Deployment completed successfully.', 200);
});
