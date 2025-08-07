<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\API\apiTrait;
use App\Traits\API\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Date;


class UserProfileController extends Controller {
    use apiTrait, ImageTrait;
    private $user;
    public function __construct() {
        $this->getUser();
    }
    public function getUser() {
        try {
            $this->user = User::find(Auth::id());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Error', $e->getCode());
        }
        $this->user = $this->user = User::find(Auth::id());
    }
    public function index() {
        return $this->successResponse($this->user, 'User Profile', 201);
    }
    public function update(Request $request) {
        $request->validate([
            'name' => 'sometimes|min:5|max:255|string',
            'phone' => 'sometimes|digits:10',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthdate' => ['sometimes', (new Date)->format('d/m/Y')->beforeToday()]
        ]);
        // dd($request->avatar);
        if ($request->hasFile('avatar')) {
            $imagePath = $this->updateImage($request->file('avatar'), $this->user->avatar, 'avatars');
            $this->user->update(['avatar' => $imagePath]);
        }
        return $this->successResponse($this->user, "User profile updated", 201);
    }
    public function destory(Request $request) {
        if (!$request->filled('password')) {
            return $this->errorResponse(null, 'You have to confirm your password', 403);
        }
        if (!Hash::check($request->password, $this->user->password)) {
            return $this->errorResponse(null, 'Password is incorrect', 403);
        }
        //Soft-delete
        $this->user->delete();
        return $this->successResponse([], "Account Deleted successfully");
    }
}
