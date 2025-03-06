<?php

namespace App\Livewire\Rfq;

use App\Models\Product;
use Livewire\Component;

class Step1 extends Component
{
    public $products = [];
    public $allProducts = [];

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


    public function render()
    {
        return view('livewire.rfq.step1');
    }
}
