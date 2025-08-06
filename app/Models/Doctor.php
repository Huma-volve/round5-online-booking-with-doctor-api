<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   protected $fillable = [
      'name',
      'email',
      'phone',
      'specialist_id',
      'bio',
      'available_slots',
      'status',
      'profile_image'
   ];


     protected $casts = [
        'available_slots' => 'array',
        'status' => 'boolean',
     ];

     public function specialist()
     {
        return $this->belongsTo(Specialist::class);
     }
}
