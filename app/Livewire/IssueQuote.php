<?php

namespace App\Livewire;

use App\Models\Quote;
use App\Models\QuoteItem;
use Livewire\Component;

class IssueQuote extends Component
{
    public $quote;
    public $productPrices = [];
    public $grandTotal = 0;
    public $notes;

    public function mount($id)
    {
        $this->quote = Quote::findOrFail($id);

        foreach ($this->quote->products as $index => $product) {
            $this->productPrices[$index] = [
                'unitPrice' => null,
                'total' => 0
            ];
        }
    }

    public function calculateTotal($index)
    {
        $product = $this->quote->products[$index];
        $quantity = $product->pivot->quantity;
        $unitPrice = floatval($this->productPrices[$index]['unitPrice'] ?? 0);

        $total = $quantity * $unitPrice;

        $this->productPrices[$index]['total'] = round($total, 2);

        $this->calculateGrandTotal();
    }

    public function calculateGrandTotal()
    {
        $this->grandTotal = 0;

        foreach ($this->productPrices as $price) {
            $this->grandTotal += floatval($price['total'] ?? 0);
        }

        $this->grandTotal = round($this->grandTotal, 2);
    }

    public function issueQuote()
    {
        $this->validate([
            'productPrices.*.unitPrice' => 'required|numeric|min:0',
        ], [
            'productPrices.*.unitPrice.required' => 'Unit price is required for all products.',
            'productPrices.*.unitPrice.numeric' => 'Unit price must be a number.'
        ]);

        foreach ($this->quote->products as $index => $product) {
            $quoteItem = QuoteItem::where('quote_id', $this->quote->id)
                ->where('product_id', $product->id);

            foreach ($quoteItem->get() as $quoteItem) {
                $quoteItem->price = $this->productPrices[$index]['total'];
                $quoteItem->save();
            }

        }

        $this->quote->price = $this->grandTotal;
        $this->quote->save();

        return $this->redirect('/rfq/detail/' . $this->quote->id, navigate: true);
    }

    public function cancel()
    {
        return $this->redirect('/rfq/detail/' . $this->quote->id, navigate: true);
    }

    public function render()
    {
        return view('livewire.issue-quote');
    }
}
