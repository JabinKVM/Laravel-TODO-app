<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [

        'user_id',

        'name',

        'email',

        'phone',

        'address',

        'status',

    ];

    /**
     * Attribute Casting
     */
    protected $casts = [

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
     * Students
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

}