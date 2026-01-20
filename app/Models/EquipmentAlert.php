<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'assigned_equipment_id', 'patient_id', 'type', 'description', 'status'
    ];

    public function assignedEquipment()
    {
        return $this->belongsTo(AssignedEquipment::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
