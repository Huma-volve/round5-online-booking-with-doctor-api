<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model {
    protected $fillable = [
        'user_id',
        'specialist_id',
        'hospital_id',
        'about',
        'experience_years',
        'price_per_hour',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function specialist() {
        return $this->belongsTo(Specialist::class);
    }

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }
    
}
