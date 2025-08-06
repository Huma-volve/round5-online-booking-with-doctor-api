<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use App\Http\Controllers\AppointmentController;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Http\Controllers\StripeController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/webhook-handler', function () {
    
    $process = new Process(['/bin/bash', '/home/digital07/round5-online-booking-with-doctor-api.digital-vision-solutions.com/deploy.sh']);
    
    try {
        $process->mustRun(); 
    } catch (ProcessFailedException $exception) {
        return response('Deployment failed: ' . $exception->getMessage(), 500);
    }

    return response('Deployment completed successfully.', 200);
});
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




