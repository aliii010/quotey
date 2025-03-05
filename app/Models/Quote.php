<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'quote_items')
            ->withPivot('unit', 'quantity', 'insulation', 'stand');
    }
}
