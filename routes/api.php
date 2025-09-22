<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\API\Pages\PagesController;
use App\Http\Controllers\SearchHistoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavouriteController;

// اختبار المستخدم الحالي
Route::get('/user', function (Request $request) {
    return [
        'user' => $request->user(), // Spatie returns a collection of role names
    ];
})->middleware('auth:sanctum');

// ========================
// مسارات محمية بـ auth:sanctum
// ========================
Route::middleware('auth:sanctum')->group(function () {

    // ================= Booking system =================
    Route::get('/doctors/{doctor}/available-slots', [AppointmentController::class, 'availableSlots']);
    Route::post('/appointments', [AppointmentController::class, 'book']);
    Route::get('/my-bookings', [AppointmentController::class, 'myBookings']);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel']);
    Route::post('/appointments/stripe-session', [StripeController::class, 'createStripeSession']);
    Route::post('/stripe/webhook', [StripeController::class, 'handleWebhook']);

    // ================= Auth protected routes =================
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/profile', [AuthController::class, 'updateProfile']);
    Route::get('/set_notification', [AuthController::class, 'is_notifiable']);
    Route::post('/delete_account', [AuthController::class, 'deleteAccount']);

    // Card Routes
    Route::apiResource('cards', CardController::class);

    // ================= Notification routes =================
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/unread-count', [NotificationController::class, 'unreadCount']);
        Route::get('/{id}', [NotificationController::class, 'show']);
        Route::patch('/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
        Route::patch('/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
        Route::delete('/{id}', [NotificationController::class, 'destroy']);
        Route::delete('/', [NotificationController::class, 'destroyAll']);
    });

    // ================= Admin routes =================
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::resource('faqs', FaqController::class);
        Route::resource('pages', PagesController::class);
    });


    // ================= Deployment Webhook =================
    Route::get('/webhook-handler', function () {
        $process = new Process(['/bin/bash', '/home/digital07/round5-online-booking-with-doctor-api.digital-vision-solutions.com/deploy.sh']);
        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            return response('Deployment failed: ' . $exception->getMessage(), 500);
        }
        return response('Deployment completed successfully.', 200);
    });
});

// ================= Public routes =================
Route::get('pages/{type}', [PagesController::class, 'show']);
Route::get('faqs', [FaqController::class, 'index']);
Route::get('faqs/{id}', [FaqController::class, 'show']);


Route::get('doctors', [DoctorController::class, 'index']);
Route::get('doctors/search', [DoctorController::class, 'search']);
Route::get('doctors/{id}', [DoctorController::class, 'show']);
Route::get('specialities', [SpecialistController::class, 'index']);
Route::get('specialities/{id}', [SpecialistController::class, 'show']);

Route::get('doctors/{doctorId}/reviews', [ReviewController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Favourites (Doctors)
    Route::get('favourites/doctors', [FavouriteController::class, 'index']);
    Route::post('favourites/doctors/{doctorId}', [FavouriteController::class, 'store']);
    Route::delete('favourites/doctors/{doctorId}', [FavouriteController::class, 'destroy']);

    // Reviews
    Route::post('doctors/{doctorId}/reviews', [ReviewController::class, 'store']);

    Route::get('searchHistories', [SearchHistoryController::class, 'searchHistory']);
    Route::post('searchHistories', [SearchHistoryController::class, 'storeSearchHistory']);
});


// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ================= Password reset =================
Route::post('/send-reset-otp', [AuthController::class, 'sendResetOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
