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

    public function index(){
        $doctors=DoctorProfile::all();
        return $this->successResponse($data = $doctors, $message = 'Success',200);
    }

    public function show($id) {
        $doctor = DoctorProfile::find($id);
        if (!$doctor) {
            return $this->errorResponse('Doctor not found', 404);
        }
        return $this->successResponse($doctor, 'Doctor retrieved successfully', 200);
    }













    
    public function search(Request $request) {
     $request->validate([
        'name' => 'nullable|string',
        'specialties' => 'nullable|string',
        'city' => 'nullable|string',
        'address' => 'nullable|string',
        'rating' => 'nullable|string',
    ]);

    $query = Specialty::query()
        ->join('doctor_profiles', 'specialties.id', '=', 'doctor_profiles.specialties_id')
        ->join('users', 'doctor_profiles.user_id', '=', 'users.id')
        ->join('locations', function ($join) {
            $join->on('users.id', '=', 'locations.addressable_id')
                 ->where('locations.addressable_type', '=', 'App\\Models\\User');
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

    if ($request->filled('specialties')) {
        $query->where('specialties.name', $request->specialties);
    }

    if ($request->filled('city')) {
        $query->where('locations.city', 'LIKE', '%' . $request->city . '%');
    }

    if ($request->filled('address')) {
        $query->where('locations.address', 'LIKE', '%' . $request->address . '%');
    }

    if ($request->filled('rating')) {
        $query->where('doctor_profiles.rating', '>=', $request->rating);
    }

    $doctors = $query->get();

        return $this->successResponse($doctors, 'Doctor retrieved successfully', 200);
    }

}
