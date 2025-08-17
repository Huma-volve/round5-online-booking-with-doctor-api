<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model {
    protected $fillable = [
        'user_id',
        'specialty_id',
        'hospital_id',
        'about',
        'price_per_hour',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }
    
    // App/Models/DoctorProfile.php

public function doctor()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
