<?php

namespace App\Models;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 'doctor_id', 'date', 'time', 'status', 'is_paid', 'payment_reference'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

