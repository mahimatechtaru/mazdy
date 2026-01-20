<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'faq_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the FAQ items for the category.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        // One Category has Many FaqItems
        return $this->hasMany(FaqItem::class, 'category_id')->orderBy('sort_order', 'asc');
    }
}