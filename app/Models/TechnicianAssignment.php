<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianAssignment extends Model
{
    use HasFactory;
    protected $fillable = ['alert_id', 'technician_id', 'status', 'visit_date'];

    public function alert()
    {
        return $this->belongsTo(EquipmentAlert::class);
    }

    public function technician()
    {
        return $this->belongsTo(Vendor::class, 'technician_id');
    }
}
