<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {
    protected $fillable = [
        'user_id',
        'card_holder_name',
        'brand',
        'exp_month',
        'exp_year',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
