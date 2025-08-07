<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
=======

use App\Models\Card;
use App\Models\DoctorProfile;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
<<<<<<< HEAD
    use HasFactory, Notifiable , HasRoles;
=======

    use HasFactory, Notifiable, HasRoles, HasApiTokens;
>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
=======


        'phone',
        'birthdate',
        'avatar',

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
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
<<<<<<< HEAD
    protected function casts(): array
    {
=======

    protected function casts(): array {

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
<<<<<<< HEAD
=======

    public function doctorProfile() {
        return $this->hasOne(DoctorProfile::class);
    }
    public function location() {
        return $this->morphTo(Location::class, 'addressable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards() {
        return $this->hasMany(Card::class, 'user_id');
    }

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
}
