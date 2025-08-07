<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SearchHistory extends Model
{
		
    protected $fillable = [
        'user_id',
        'search_term',
        'location',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
