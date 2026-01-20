<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id', 'patient_id', 'equipment_id', 'status', 'requested_date', 'special_instructions'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
