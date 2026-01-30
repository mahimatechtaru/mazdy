<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * Table Name (optional agar default `properties` hai)
     */
    protected $table = 'cities';

    /**
     * Mass Assignable Fields
     */
    protected $fillable = ['icon','name', 'status' ];

    
    

}
