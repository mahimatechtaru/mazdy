<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
     protected $fillable = [
        'name', 'email', 'subject', 'message', 'phone'
    ];
}
