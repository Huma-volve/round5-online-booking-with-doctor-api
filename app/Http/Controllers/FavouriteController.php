<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\API\apiTrait;

class FavouriteController extends Controller
{
    use apiTrait;

    public function index()
    {
        $userId = Auth::id();

        $favourites = Favourite::with(['favouritable' => function ($morph) {
            $morph->select('id', 'name', 'email', 'phone', 'type');
        }])
            ->where('user_id', $userId)
            ->where('favouritable_type', User::class)
            ->get()
            ->filter(function ($fav) {
                return optional($fav->favouritable)->type === 'doctor';
            })
            ->values();

        return $this->successResponse($favourites, 'Favourite doctors retrieved successfully', 200);
    }

    public function store($doctorId)
    {
        $user = Auth::user();
        $doctor = User::where('id', $doctorId)->where('type', 'doctor')->first();
        if (!$doctor) {
            return $this->errorResponse(null, 'Doctor not found', 404);
        }

        $favourite = Favourite::firstOrCreate([
            'user_id' => $user->id,
            'favouritable_type' => User::class,
            'favouritable_id' => $doctor->id,
        ]);

        return $this->successResponse($favourite, 'Doctor added to favourites', 201);
    }

    public function destroy($doctorId)
    {
        $userId = Auth::id();

        $deleted = Favourite::where('user_id', $userId)
            ->where('favouritable_type', User::class)
            ->where('favouritable_id', $doctorId)
            ->delete();

        if (!$deleted) {
            return $this->errorResponse(null, 'Favourite not found', 404);
        }

        return $this->successResponse(null, 'Doctor removed from favourites', 200);
    }
}


