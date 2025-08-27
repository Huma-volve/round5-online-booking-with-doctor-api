<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'doctor']);

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('booking_date', [$request->from, $request->to]);
        }

        $bookings = $query->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $doctors = Doctor::all();
       return view ('bookings.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'doctor_id'    => 'required|exists:doctors,id',
        'time_slot'    => 'required|string',
        'booking_date' => 'required|date|after_or_equal:today',
       ]);

     $booking = Booking::create([
        'user_id'      => auth()->id(),
        'doctor_id'    => $request->doctor_id,
        'time_slot'    => $request->time_slot,
        'booking_date' => $request->booking_date,
        'status'       => 'pending', // default status
    ]);

      return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
       $request->validate([
            'status'=>'required|in:pending,confirmed,canceled,completed'
        ]);

        $booking->update(['status'=>$request->status]);
        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings.index');
    }
}
