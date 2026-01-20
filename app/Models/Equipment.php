<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'model', 'description', 'photo', 'last_service_date'];

    public function assignedEquipments()
    {
        return $this->hasMany(AssignedEquipment::class);
    }
}
