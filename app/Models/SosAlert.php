<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'location_address',
        'emergency_details',
        'status','doctor_id','ambulance_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
    
    public function ambulance()
    {
        return $this->belongsTo(User::class, 'ambulance_id', 'id');
    }

}
