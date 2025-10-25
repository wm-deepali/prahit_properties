<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $table = 'faq_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id');
    }

    /**
     * Use slug as route key instead of id.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
