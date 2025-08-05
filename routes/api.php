<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use App\Http\Controllers\API\Pages\PagesController;
use App\Http\Controllers\API\UserProfileController;
use App\Http\Controllers\FaqController;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::get('/user', function (Request $request) {
    $user = $request->user();
    return [
        'user' => $user, // Spatie returns a collection of role names
    ];
})->middleware('auth:sanctum');


//public routes
Route::get('pages/{type}', [PagesController::class, 'show']);
Route::get('faqs', [FaqController::class, 'index']);
Route::get('faqs/{id}', [FaqController::class, 'show']);

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index']);
    Route::put('/profile', [UserProfileController::class, 'update']);

    // Auth protected routes
    Route::post('/logout', [AuthController::class, 'logout']);
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
