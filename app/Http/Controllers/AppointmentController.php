<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    
public function availableSlots($userId)
{
    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(7);

    $availableTimes = [
        '09:00', '10:00', '11:00', '12:00',
        '13:00', '14:00', '15:00', '16:00'
    ];

    $slots = [];

    for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
        foreach ($availableTimes as $time) {
            $alreadyBooked = Appointment::where('user_id', $userId) // بدل doctor_profile_id
                ->whereDate('appointment_date', $date)
                ->where('appointment_time', $time)
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
        'user_id' => $userId,
        'available_slots' => $slots,
    ]);
}


  public function book(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,id',
            'doctor_profile_id' => 'required|exists:doctor_profiles,id',
            'date'              => 'required|date|after_or_equal:today',
            'time'              => 'required|date_format:H:i',
            'price'             => 'nullable|numeric',
            'payment_id'        => 'nullable|exists:payments,id',
        ]);

        // التحقق من وجود حجز بنفس الموعد
        $alreadyBooked = Appointment::where('doctor_profile_id', $request->doctor_profile_id)
            ->where('appointment_date', $request->date)
            ->where('appointment_time', $request->time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($alreadyBooked) {
            return response()->json(['message' => 'This time slot is already booked.'], 409);
        }

        $appointment = Appointment::create([
            'user_id'           => $request->user_id,
            'doctor_profile_id' => $request->doctor_profile_id,
            'appointment_date'  => $request->date,
            'appointment_time'  => $request->time,
            'status'            => 'pending',
            'price'             => $request->price ?? 0,
            'payment_id'        => $request->payment_id,
        ]);

        return response()->json([
            'message'     => 'Appointment booked successfully.',
            'appointment' => $appointment,
        ], 201);
    }

    // عرض جميع المواعيد الخاصة بالمستخدم
    public function myAppointments(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $appointments = Appointment::with('doctorProfile.doctor')
            ->where('user_id', $request->user_id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json($appointments);
    }
}


// public function myBookings(Request $request)
// {
//     $userId = Auth::id();
//     $filter = $request->query('filter', 'upcoming');

//     $query = Appointment::with('doctor')
//         ->where('user_id', $userId);

//     if ($filter === 'upcoming') {
//         $query->whereDate('date', '>=', Carbon::today());
//     } elseif ($filter === 'past') {
//         $query->whereDate('date', '<', Carbon::today());
//     }

//     $appointments = $query->orderBy('date', 'asc')->get();

//     return response()->json([
//         'filter' => $filter,
//         'appointments' => $appointments,
//     ]);
// }
//   public function cancel($id)
// {
//     $appointment = Appointment::find($id);

//     if (!$appointment) {
//         return response()->json(['message' => 'Appointment not found.'], 404);
//     }

    
//     if ($appointment->user_id !== Auth::id()) {
//         return response()->json(['message' => 'Unauthorized'], 403);
//     }

    
//     if (Carbon::parse($appointment->date)->lt(Carbon::today())) {
//         return response()->json(['message' => 'Cannot cancel a past appointment.'], 400);
//     }

    
//     $appointment->update(['status' => 'cancelled']);

//     return response()->json(['message' => 'Appointment cancelled successfully.']);
// }

