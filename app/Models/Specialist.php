<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
     protected $fillable = ['name_en', 'name_ar', 'description', 'icon', 'status'];


      protected $casts = [
        'status' => 'boolean',
    ];

     public function doctors()
     {
        return $this->belongsToMany(Doctor::class);
     }
}
