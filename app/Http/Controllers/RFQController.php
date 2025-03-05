<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class RFQController extends Controller
{
    public function showStep1()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('rfq.step1', compact('products', 'categories'));
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.unit' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.insulation' => 'required|in:Insulated,Non-insulated',
            'products.*.stand' => 'required|in:Yes,No'
        ]);

        session(['rfq_step1' => $request->input('products')]);

        return redirect()->route('rfq.step2');
    }
}
