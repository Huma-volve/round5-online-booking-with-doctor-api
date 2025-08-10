<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Doctor extends Model implements HasMedia
{
use InteractsWithMedia;
   protected $fillable = [
      'name',
      'email',
      'phone',
      'specialist_id',
      'bio',
      'available_slots',
      'status',
     
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
