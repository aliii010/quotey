<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'GRP Water Tank',
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'GRP(SMC) Sheet',
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'GRP Door',
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'ENM Water Tank',
        ]);
    }
}
