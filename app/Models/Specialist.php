<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Specialist extends Model implements HasMedia
{
  use InteractsWithMedia;
    protected $table = 'specialists';

     protected $fillable = ['name_en', 'name_ar', 'description', 'icon', 'status'];

      protected $casts = [
        'status' => 'boolean',
    ];

     public function doctors()
     {
        return $this->belongsToMany(Doctor::class);
     }
}
