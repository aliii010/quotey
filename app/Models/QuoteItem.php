<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $table = 'quote_items';

    protected $fillable = [
        'quote_id',
        'product_id',
        'unit',
        'quantity',
        'insulation',
        'stand',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
