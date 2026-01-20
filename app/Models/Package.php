<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'short_description', 'description',
        'plan_type', 'price', 'duration', 'badge', 'target_audience',
        'inclusions', 'exclusions', 'faqs', 'terms', 'cancellation_policy', 'is_active'
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'faqs' => 'array',
    ];
}
