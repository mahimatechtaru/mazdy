<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'relationship',
        'date_of_birth',
        'gender',
        'medical_history',
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
