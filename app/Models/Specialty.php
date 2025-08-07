<?php

namespace App\Models;

use App\Models\DoctorProfile;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model {

    protected $table = 'specialists';

    protected $fillable = [
        'name',
        'icon'
    ];
    public function doctors() {
        return $this->hasMany(DoctorProfile::class);
    }
}
