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
        'products.*.unit' => 'required|string', // TODO : wxdxh for GRP and m³ for ENM
        'products.*.quantity' => 'required|integer|min:5',
        'products.*.insulation' => 'required|in:Insulated,Non-insulated',
        'products.*.stand' => 'required|in:Yes,No',
    ];

    public function mount()
    {
        $this->allProducts = Product::all();

        if (session()->has('rfq_step1')) {
            $this->products = session('rfq_step1');
        } else {
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

        session(['rfq_step1' => $this->products]);

        $this->redirect('/rfq/step2', navigate: true);
    }


    public function render()
    {
        return view('livewire.rfq.step1')->layout('layouts.rfq');
    }
}
