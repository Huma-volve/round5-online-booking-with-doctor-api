<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialists = Specialist::all();
        return view('admin.specialists.index', compact('specialists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialist = new Specialist();
        return view('admin.specialists.create', compact('specialist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'is_active' => 'nullable|boolean'
        ]);
        $specialist = Specialist::create(collect($validated)->except('icon')->toArray());
        if ($request->hasFile('icon')) {
            $specialist->addMediaFromRequest('icon')
                ->toMediaCollection('icons');
        };
        return redirect()->route('specialists.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $specialist = Specialist::findOrFail($id);
        return view('admin.specialists.show', compact('specialist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specialist = Specialist::findOrFail($id);
        return view('admin.specialists.edit', compact('specialist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
           'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'is_active' => 'nullable|boolean'
        ]);
        $specialist = Specialist::findOrFail($id);
        $specialist->update(collect($validated)->except('icon')->toArray());
        if ($request->hasFile('icon')) {
            $specialist->addMediaFromRequest('icon')
                ->toMediaCollection('icons');
        }
        return redirect()->route('specialists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->delete();
        return redirect()->route('specialists.index');
    }
}
