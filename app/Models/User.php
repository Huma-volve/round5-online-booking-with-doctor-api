<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Card;
use App\Models\DoctorProfile;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable {
    /** @use HasFactory<\Database\Factories\UserFactory> */

    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',


        'phone',
        'birthdate',
        'avatar',
        'is_notifiable'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array {

        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function doctorProfile() {
        return $this->hasOne(DoctorProfile::class);
    }
    public function location() {
        return $this->morphTo(Location::class, 'addressable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards() {
        return $this->hasMany(Card::class, 'user_id');
    }
    public function searchHistory() {
        return $this->hasMany(SearchHistory::class);
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
