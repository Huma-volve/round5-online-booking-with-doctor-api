<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Doctor extends Model implements HasMedia
{
use InteractsWithMedia , Searchable;
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

     public function toSearchableArray()
     {
         return [
               'name' => $this->name,
               'email' => $this->email,
               'phone' => $this->phone,
         ];
      }

     public function specialist()
     {
        return $this->belongsTo(Specialist::class);
     }
}
