<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    protected $fillable = [
        'user_id',
        'doctor_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}


