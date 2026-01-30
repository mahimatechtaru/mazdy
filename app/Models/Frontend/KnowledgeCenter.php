<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeCenter extends Model
{
    use HasFactory;

    protected $table = 'knowledge_center';

    protected $casts = [
        'id'           => 'integer',
        'title'  =>  'string',
        'doc'         => 'string',
        'created_at'   => 'date:Y-m-d',
        'updated_at'   => 'date:Y-m-d',
    ];


    protected $guarded = [
        'id',
    ];
}
