<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\API\apiTrait;

class FavouriteController extends Controller
{
    use apiTrait;

    public function index()
    {
        $userId = Auth::id();

        // Get favourite doctor IDs for the current user
        $favouriteDoctorIds = Favourite::where('user_id', $userId)
            ->where('favouritable_type', User::class)
            ->pluck('favouritable_id');

        $doctors = DoctorProfile::join('users', 'doctor_profiles.user_id', '=', 'users.id')
            ->join('hospitals', 'doctor_profiles.hospital_id', '=', 'hospitals.id')
            ->join('specialists', 'doctor_profiles.specialist_id', '=', 'specialists.id')
            ->leftJoin('doctor_schedules', 'doctor_profiles.id', '=', 'doctor_schedules.doctor_id')
            ->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
            ->whereIn('users.id', $favouriteDoctorIds)
            ->select(
                'doctor_profiles.id as doctor_profile_id',
                'doctor_profiles.about',
                'doctor_profiles.experience_years',
                'doctor_profiles.price_per_hour',
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.phone',
                'specialists.id as specialty_id',
                'specialists.name_en as specialty_name_en',
                'specialists.name_ar as specialty_name_ar',
                'specialists.description as specialty_description',
                'hospitals.id as hospital_id',
                'hospitals.name as hospital_name',
                'hospitals.city as hospital_city',
                'hospitals.open_at as hospital_start_time',
                'hospitals.close_at as hospital_end_time',
                'doctor_schedules.id as availability_id',
                'doctor_schedules.day',
                'doctor_schedules.start_time',
                'doctor_schedules.end_time',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as average_rating'),
                DB::raw('COUNT(reviews.id) as reviews_count')
            )
            ->groupBy(
                'doctor_profiles.id',
                'doctor_profiles.about',
                'doctor_profiles.experience_years',
                'doctor_profiles.price_per_hour',
                'users.id',
                'users.name',
                'users.email',
                'users.phone',
                'specialists.id',
                'specialists.name_en',
                'specialists.name_ar',
                'specialists.description',
                'hospitals.id',
                'hospitals.name',
                'hospitals.city',
                'hospitals.open_at',
                'hospitals.close_at',
                'doctor_schedules.id',
                'doctor_schedules.day',
                'doctor_schedules.start_time',
                'doctor_schedules.end_time'
            )
            ->get();

        return $this->successResponse($doctors, 'Favourite doctors retrieved successfully', 200);
    }

    public function store($doctorId)
    {
        $user = Auth::user();
        $doctor = User::where('id', $doctorId)->whereHas('doctorProfile')->first();
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


