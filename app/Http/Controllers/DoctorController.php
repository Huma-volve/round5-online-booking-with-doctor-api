<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'hospitals.open_at as hospital_start_time',
            'hospitals.close_at as hospital_end_time',
            'doctor_schedules.id as availability_id',
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
            'hospitals.open_at as hospital_start_time',
            'hospitals.close_at as hospital_end_time',
            'doctor_schedules.id as availability_id',
            'doctor_schedules.day',
            'doctor_schedules.start_time',
            'doctor_schedules.end_time'
        )
        ->find($id);
        if (!$doctor) {
            return $this->errorResponse('Doctor not found', 404);
        }
        return $this->successResponse($doctor, 'Doctor retrieved successfully', 200);
    }


    public function search(Request $request) {

        $query = Specialty::query()
        ->join('doctor_profiles', 'specialists.id', '=', 'doctor_profiles.specialist_id')
        ->join('users', 'doctor_profiles.user_id', '=', 'users.id')
        ->join('locations', function ($join) {
            $join->on('users.id', '=', 'locations.addressable_id')
                 ->where('locations.addressable_type', '=', 'user');
        })
        ->select(
            'doctor_profiles.*',
            'users.name',
            'users.phone',
            'users.avatar',
            'users.email',
            'locations.city',
            'locations.address'
        );

    if ($request->filled('name')) {
        $query->where('users.name', 'LIKE', '%' . $request->name . '%');
    }

    if ($request->filled('specialists')) {
        $query->where('specialists.name_en', $request->specialists);
    }

    if ($request->filled('city')) {
        $query->where('locations.city', 'LIKE', '%' . $request->city . '%');
    }

    if ($request->filled('address')) {
        $query->where('locations.address', 'LIKE', '%' . $request->address . '%');
    }


    $doctors = $query->get();

        return $this->successResponse($doctors, 'Doctor retrieved successfully', 200);
    }

}
