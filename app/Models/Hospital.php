<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;


class Hospital extends Model {
    protected $fillable = [
        'name',
        'city',
        'open_at',
        'close_at',
        'photo',
    ];
    public function location() {
        return $this->morphTo(Location::class, 'addressable');
    }
}
