<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\API\apiTrait;

class ReviewController extends Controller
{
    use apiTrait;

    public function index($doctorId)
    {
        $doctor = User::find($doctorId);
        if (!$doctor) {
            return $this->errorResponse('Doctor not found', 404);
        }

        $reviews = Review::with('user:id,name,avatar')
            ->where('doctor_id', $doctorId)
            ->orderByDesc('created_at')
            ->paginate(10);

        return $this->successResponse($reviews);
    }

    public function store(Request $request, $doctorId)
    {
        $doctor = User::find($doctorId);
        if (!$doctor) {
            return $this->errorResponse('Doctor not found', 404);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
        ]);

        $review = Review::create([
            'user_id' => $request->user()->id,
            'doctor_id' => $doctorId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return $this->successResponse($review, 'Review submitted successfully', 201);
    }
}


