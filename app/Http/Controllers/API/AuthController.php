<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\SendResetOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\PasswordResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while registering.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function login(LoginRequest $request)
    {

        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect email or password'
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'You have successfully logged in.',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while logging in.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'You have successfully logged out.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while logging out.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $request->user();

        try {
            $updateData = $request->only(['name', 'phone', 'birthdate']);

            Log::info($request->only(["name"]));
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($user->avatar && file_exists(public_path('storage/' . $user->avatar))) {
                    unlink(public_path('storage/' . $user->avatar));
                }

                // Store new avatar
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $updateData['avatar'] = $avatarPath;
            }

            $user->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'user' => new UserResource($user)
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating profile.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function me(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => new UserResource($user)
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching user information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function sendResetOtp(SendResetOtpRequest $request)
    {
        try {
            $email = $request->email;

            // حذف أي OTP سابق لهذا البريد
            PasswordResetOtp::where('email', $email)->delete();

            // إنشاء OTP جديد
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiresAt = now()->addMinutes(10); // OTP صالح لمدة 10 دقائق

            PasswordResetOtp::create([
                'email' => $email,
                'otp' => $otp,
                'expires_at' => $expiresAt,
            ]);

            // إرسال OTP عبر البريد الإلكتروني
            // في البيئة الحقيقية، استخدم Mail facade لإرسال البريد
            Log::info("Password reset OTP for {$email}: {$otp}");

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully to your email, ',
                'data' => [
                    'email' => $email,
                    'expires_at' => $expiresAt->toISOString(),
                    'note' => "OTP is {{$otp}} :returned here only for testing purposes and will be removed in production.",

                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error sending reset OTP: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending OTP.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;

            $otpRecord = PasswordResetOtp::where('email', $email)
                ->where('otp', $otp)
                ->where('is_used', false)
                ->where('expires_at', '>', now())
                ->first();

            if (!$otpRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully',
                'data' => [
                    'email' => $email,
                    'otp' => $otp
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error verifying OTP: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while verifying OTP.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;
            $password = $request->password;

            $otpRecord = PasswordResetOtp::where('email', $email)
                ->where('otp', $otp)
                ->where('is_used', false)
                ->where('expires_at', '>', now())
                ->first();

            if (!$otpRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP'
                ], 400);
            }

            $user = User::where('email', $email)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->update([
                'password' => Hash::make($password)
            ]);

            $user->tokens()->delete();

            $otpRecord->markAsUsed();

            PasswordResetOtp::where('email', $email)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while resetting password.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
