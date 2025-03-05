<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'quote_items')
            ->withPivot('unit', 'quantity', 'insulation', 'stand');
    }
}
