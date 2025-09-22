<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorProfile;
use App\Models\Specialty;
use App\Traits\API\apiTrait;

//   public function successResponse($data = [], $message = 'Success', $code = 200) {
//         return response()->json([
//             'status' => 'success',
//             'message' => $message,
//             'data' => $data
//         ], $code);
//     }

class DoctorController extends Controller
{
    use apiTrait;

public function index()
{
    $doctors = DoctorProfile::join('users', 'doctor_profiles.user_id', '=', 'users.id')
        ->join('hospitals', 'doctor_profiles.hospital_id', '=', 'hospitals.id')
        ->join('specialists', 'doctor_profiles.specialist_id', '=', 'specialists.id')
        ->leftJoin('doctor_schedules', 'doctor_profiles.id', '=', 'doctor_schedules.doctor_id')
        ->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
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

    return $this->successResponse($doctors, 'Success', 200);
}


    public function show($id) {
        $doctor = DoctorProfile::join('users', 'doctor_profiles.user_id', '=', 'users.id')
        ->join('hospitals', 'doctor_profiles.hospital_id', '=', 'hospitals.id')
        ->join('specialists', 'doctor_profiles.specialist_id', '=', 'specialists.id')
        ->leftJoin('doctor_schedules', 'doctor_profiles.id', '=', 'doctor_schedules.doctor_id')
        ->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
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
        ->where('doctor_profiles.id', $id)
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
        ->first();
        if (!$doctor) {
            return $this->errorResponse('Doctor not found', 404);
        }
        return $this->successResponse($doctor, 'Doctor retrieved successfully', 200);
    }













    
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'nullable|string',
        ]);

        $queryParam = $request->input('query');

        $query = DB::table('specialists as s')
            ->join('doctor_profiles as dp', 's.id', '=', 'dp.specialist_id')
            ->join('users as u', 'dp.user_id', '=', 'u.id')
            ->join('hospitals as h', 'dp.hospital_id', '=', 'h.id')
            ->leftJoin('doctor_schedules as ds', 'dp.id', '=', 'ds.doctor_id')
            ->join('locations as l', function ($join) {
                $join->on('u.id', '=', 'l.addressable_id')
                    ->where('l.addressable_type', '=', 'user');
            })
            ->select(
                'dp.id as doctor_profile_id',
                'dp.about',
                'dp.experience_years',
                'dp.price_per_hour',
                'u.id as user_id',
                'u.name',
                'u.email',
                'u.phone',
                'u.avatar',
                'l.city',
                'l.address',
                's.id as specialty_id',
                's.name_en as specialty_name_en',
                's.name_ar as specialty_name_ar',
                's.description as specialty_description',
                'h.id as hospital_id',
                'h.name as hospital_name',
                'h.city as hospital_city',
                'h.open_at as hospital_start_time',
                'h.close_at as hospital_end_time',
                'ds.id as availability_id',
                'ds.day',
                'ds.start_time',
                'ds.end_time'
            );

        if (!empty($queryParam)) {
            $query->where(function ($query) use ($queryParam) {
                $query->where('u.name', 'LIKE', "%$queryParam%")
                    ->orWhere('s.name_en', 'LIKE', "%$queryParam%")
                    ->orWhere('s.name_ar', 'LIKE', "%$queryParam%")
                    ->orWhere('l.city', 'LIKE', "%$queryParam%")
                    ->orWhere('l.address', 'LIKE', "%$queryParam%");
            });
        }

        $doctors = $query->get();

        return $this->successResponse($doctors, 'Doctors retrieved successfully', 200);
    }


}
