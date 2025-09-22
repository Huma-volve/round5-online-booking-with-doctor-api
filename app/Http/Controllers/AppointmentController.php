<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\API\apiTrait;

class AppointmentController extends Controller
{
    use apiTrait;
    
public function availableSlots($doctorId)
{
   
    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(7);


    $availableTimes = [
        '09:00', '10:00', '11:00', '12:00',
        '13:00', '14:00', '15:00', '16:00'
    ];

    $slots = [];

    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        foreach ($availableTimes as $time) {
            $alreadyBooked = Appointment::where('doctor_id', $doctorId)
                ->where('date', $date->toDateString())
                ->where('time', $time)
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if (!$alreadyBooked) {
                $slots[] = [
                    'date' => $date->toDateString(),
                    'time' => $time,
                ];
            }
        }
    }

    return response()->json([
        'doctor_id' => $doctorId,
        'available_slots' => $slots,
    ]);
}

public function book(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:users,id',
        'date'      => 'required|date|after_or_equal:today',
        'time'      => 'required|date_format:H:i',
    ]);

    $userId = Auth::id();

    
    $alreadyBooked = Appointment::where('doctor_id', $request->doctor_id)
        ->where('date', $request->date)
        ->where('time', $request->time)
        ->whereIn('status', ['pending', 'confirmed'])
        ->exists();

    if ($alreadyBooked) {
        return response()->json(['message' => 'This time slot is already booked.'], 409);
    }

    $appointment = Appointment::create([
        'user_id' => $userId,
        'doctor_id' => $request->doctor_id,
        'date' => $request->date,
        'time' => $request->time,
        'status' => 'pending', 
    ]);

    return response()->json([
        'message' => 'Appointment booked successfully.',
        'appointment' => $appointment,
    ], 201);
}
public function myBookings(Request $request)
{
    $userId = Auth::id();
    $filter = $request->query('filter', 'upcoming');

    $query = Appointment::with('doctor')
        ->where('user_id', $userId);

    if ($filter === 'upcoming') {
        $query->whereDate('date', '>=', Carbon::today());
    } elseif ($filter === 'past') {
        $query->whereDate('date', '<', Carbon::today());
    }

    $appointments = $query->orderBy('date', 'asc')->get();

    return response()->json([
        'filter' => $filter,
        'appointments' => $appointments,
    ]);
}
public function cancel($id)
{
    $appointment = Appointment::find($id);

    if (!$appointment) {
        return response()->json(['message' => 'Appointment not found.'], 404);
    }

    // Check if the user is authorized to cancel this appointment
    if ($appointment->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    // Check if appointment is already cancelled
    if ($appointment->status === 'canceled') {
        return response()->json(['message' => 'This appointment is already cancelled.'], 400);
    }

    // Check if appointment is completed
    if ($appointment->status === 'completed') {
        return response()->json(['message' => 'Cannot cancel a completed appointment.'], 400);
    }

    // Check if appointment date is in the past
    $appointmentDateTime = Carbon::parse($appointment->date . ' ' . $appointment->time);
    if ($appointmentDateTime->isPast()) {
        return response()->json(['message' => 'Cannot cancel a past appointment.'], 400);
    }

    // Cancel the appointment
    $appointment->update(['status' => 'canceled']);

    return response()->json(['message' => 'Appointment cancelled successfully.']);
}
}
