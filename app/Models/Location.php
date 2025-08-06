<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {
    protected $fillable = [
        'city',
        'lat',
        'long',
        'address',
        'addressable_type',
        'addressable_id',

    ];

    public function addressable() {
        return $this->morphTo();
    }
}
