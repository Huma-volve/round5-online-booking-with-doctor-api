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
use App\Traits\API\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller {

    use apiTrait;

    public function register(RegisterRequest $request) {

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
            $data = [
                'user' => new UserResource($user),
                'token' => $token,
                'token_type' => 'Bearer'
            ];
            return $this->successResponse($data, 'Registration successful', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while registering.', 500);
        }
    }


    public function login(LoginRequest $request) {

        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect email or password'
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->errorResponse(null, 'User not found', 404);
            }
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;
            $data = [
                'user' => new UserResource($user),
                'token' => $token,
                'token_type' => 'Bearer'
            ];
            return $this->successResponse($data, 'You have successfully logged in.', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while logging in.', 500);
        }
    }


    public function logout(Request $request) {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse([], 'You have successfully logged out.', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while logging out.', 500);
        }
    }


    public function updateProfile(UpdateProfileRequest $request) {
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
            $data = ['user' => new UserResource($user)];
            return $this->successResponse($data, 'Profile updated successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while updating profile.', 500);
        }
    }


    public function me(Request $request) {
        try {
            $user = $request->user();
            $data = ['user' => new UserResource($user)];
            return $this->successResponse($data, 'User profile retrived', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while fetching user information.', 500);
        }
    }


    public function sendResetOtp(SendResetOtpRequest $request) {
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
            $data = [
                'email' => $email,
                'expires_at' => $expiresAt->toISOString(),
                'note' => "OTP is {{$otp}} :returned here only for testing purposes and will be removed in production.",
            ];
            return $this->successResponse($data, 'OTP sent successfully to your email, ', 200);
        } catch (\Exception $e) {
            Log::error('Error sending reset OTP: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage(), 'An error occurred while sending OTP.', 500);
        }
    }

    public function verifyOtp(VerifyOtpRequest $request) {
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
            $data = [
                'email' => $email,
                'otp' => $otp
            ];
            return $this->successResponse($data, 'OTP verified successfully ', 200);
        } catch (\Exception $e) {
            Log::error('Error verifying OTP: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage(), 'An error occurred while verifying OTP.', 500);
        }
    }


    public function resetPassword(ResetPasswordRequest $request) {
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
            return $this->successResponse([], 'Password reset successfully', 200);
        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage(), 'An error occurred while resetting password.', 500);
        }
    }
    public function is_notifiable(Request $request) {
        try {
            $request->validate([
                'is_notifiable' => 'required|boolean',
            ]);
            $user = User::find(Auth::id());
            $user->is_notifiable = $request->is_notifiable;
            $user->save();
            return $this->successResponse([$user->is_notifiable], 'Notification settings updated successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while updating notifications', 500);
        }
    }
    public function deleteAccount(Request $request) {
        try {
            $user = $request->user();
            if (!$request->filled('password')) {
                return $this->errorResponse(null, 'You have to confirm your password', 403);
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->errorResponse(null, 'Password is incorrect', 403);
            }
            $user->currentAccessToken()->delete();
            $user->delete();
            return $this->successResponse([], "Account Deleted successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'An error occurred while deleting the account', 500);
        }
    }
}
