<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'package_id', 'amount', 'payment_status', 'status',
        'start_date', 'end_date', 'payment_method', 'transaction_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Helper to check if subscription is active
    public function isActive()
    {
        return $this->status === 'active' && now()->between($this->start_date, $this->end_date);
    }
}
