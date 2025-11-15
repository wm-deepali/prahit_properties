<?php

namespace App\Models;

use App\Form;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFeatureSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'field_key',
        'label_to_show',
        'icon_class',
        'sort_order',
        'show_in_front',
    ];

    /**
     * Relationship: A feature belongs to one form
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
