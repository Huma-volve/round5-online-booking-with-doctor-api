<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('specialist')->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialists = Specialist::all();
        $doctor = new Doctor();
        
        return view('admin.doctors.create', compact('specialists', 'doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return dd('debug');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'specialist_id' => 'required|exists:specialists,id',
            'bio' => 'nullable|string',
            'available_slots' => 'required|array',
            'status' => 'required|boolean',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         // Prepare doctor data without image path initially
        $doctor = Doctor::create(collect($validated)->except('profile_image')->toArray());

    // If image uploaded, store it and add path to data
        if ($request->hasFile('profile_image')) {
            $doctor->addMediaFromRequest('profile_image')
            ->toMediaCollection('profile_images'); 
        }

         return redirect()->route('doctors.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::with('specialist')->findOrFail($id);
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $specialists = Specialist::all();

        return view('admin.doctors.edit', compact('doctor', 'specialists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'specialist_id' => 'required|exists:specialists,id',
        'bio' => 'nullable|string',
        'available_slots' => 'nullable|array',
        'status' => 'required|boolean',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
     
        $doctor = Doctor::findOrFail($id);

         $doctor->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'specialist_id' => $validated['specialist_id'],
        'bio' => $validated['bio'],
        'available_slots' => $validated['available_slots'], // Casted to JSON in model
        'status' => $validated['status'],
        'profile_image' => $validated['profile_image'] ?? $doctor->profile_image,
    ]);
        return redirect()->route('doctors.index');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index');
    }
}
