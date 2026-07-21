<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [

        'user_id',

        'school_id',

        'student_id',

        'name',

        'email',

        'phone',

        'gender',

        'dob',

        'department',

        'address',

        'profile_photo',

        'status',

    ];

    /**
     * Attribute Casting
     */
    protected $casts = [

        'dob' => 'date',

        'status' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Login Account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * School
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function tasks()
{
    return $this->hasMany(Task::class);
}

}