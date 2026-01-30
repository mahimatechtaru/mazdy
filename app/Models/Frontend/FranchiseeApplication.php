<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseeApplication extends Model
{
    use HasFactory;

    protected $table = 'franchisee_applications';

    protected $guarded = ['id'];

    protected $fillable = [
        'full_name',
        'mobile_number',
        'email',
        'city',
        'state',
        'business_type',
        'operating_centre',
        'message',
        'consent',
    ];
}
