<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','vendor_type','license_number','specialization',
        'experience_years','bio','status'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getProviders($role = null)
    {
        $query = self::with('user');
        if ($role) $query->where('vendor_type', $role);
        return $query->get();
    }
    
    public static function countProviders($role = null)
    {
        $query = self::query();
        if ($role) $query->where('vendor_type', $role);
        return $query->count();
    }

}
