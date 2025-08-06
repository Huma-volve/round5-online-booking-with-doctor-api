<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Traits\API\apiTrait;

class SpecialistController extends Controller
{
    use apiTrait;

    public function index(){
        $specialities=Specialty::all();
        return $this->successResponse($data = $specialities, $message = 'Success');
    }

    public function show($id) {
        $speciality = Specialty::find($id);
        if (!$speciality) {
            return $this->errorResponse('speciality not found', 404);
        }
        return $this->successResponse($speciality, 'speciality retrieved successfully', 200);
    }

}
