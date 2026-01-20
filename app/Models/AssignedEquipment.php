<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedEquipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_id', 'patient_id', 'vendor_id', 'status', 'assigned_date', 'expected_return_date'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function alerts()
    {
        return $this->hasMany(EquipmentAlert::class);
    }
}
