<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'name',
        'description',
        'category',
        'base_price',
        'additional_charges',
    ];
    public function ServicesCategory()
    {
        return $this->belongsTo(ServicesCategory::class, 'category', 'id');
    }
}
