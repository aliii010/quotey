<?php

namespace App\Livewire\Rfq;

use App\Models\Product;
use Livewire\Component;

class Step1 extends Component
{
    public $products = [];
    public $allProducts = [];

    protected $rules = [
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.unit' => 'required|string',
        'products.*.quantity' => 'required|integer|min:5',
        'products.*.insulation' => 'required|in:Insulated,Non-insulated',
        'products.*.stand' => 'required|in:Yes,No',
    ];

    public function mount()
    {
        $this->allProducts = Product::all();
        $this->products = [
            [
                'product_id' => '',
                'unit' => '',
                'quantity' => '',
                'insulation' => 'Insulated',
                'stand' => 'Yes'
            ],
        ];
    }

    public function addProduct()
    {
        $this->products[] = [
            'product_id' => '',
            'unit' => '',
            'quantity' => '',
            'insulation' => 'Insulated',
            'stand' => 'Yes'
        ];
    }

    public function removeProduct($index)
    {
        if (count($this->products) > 1) {
            unset($this->products[$index]);
            $this->products = array_values($this->products);
        }
    }

    public function submit()
    {
        $this->validate();

        dd($this->products);

        // Store in session
        session(['rfq_step1' => $this->products]);

        // Redirect to next step
        return redirect()->route('rfq.step2');
    }


    public function render()
    {
        return view('livewire.rfq.step1');
    }
}
