<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssinedProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'doctor_id',
        'ambulance_id',
    ];
    
    /**
     * Get the user (patient) associated with the provider assignment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor assigned to the user.
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the ambulance assigned to the user.
     */
    public function ambulance()
    {
        return $this->belongsTo(User::class, 'ambulance_id');
    }
}
