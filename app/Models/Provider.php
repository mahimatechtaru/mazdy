<?php 
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Provider extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'last_name', 'email', 'mobile', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

?>