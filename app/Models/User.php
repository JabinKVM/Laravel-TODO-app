<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [

        'name',

        'email',

        'password',

        'role',

        'status',

        'profile_photo',

    ];

    /**
     * Hidden
     */
    protected $hidden = [

        'password',

        'remember_token',

    ];

    /**
     * Attribute Casting
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'status' => 'boolean',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Admin -> School
     */
    public function school()
    {
        return $this->hasOne(School::class);
    }

    /**
     * Student Login Account
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSchool()
    {
        return $this->role === 'school';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

}