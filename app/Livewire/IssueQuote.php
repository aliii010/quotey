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

        foreach ($this->quote->quote_items as $quote_item) {
            $this->productPrices[$quote_item->id] = [
                'unitPrice' => null,
                'total' => 0
            ];
        }
    }

    public function calculateTotal($quoteItemId)
    {
        $quote_item = QuoteItem::find($quoteItemId);

        $product = $quote_item->product;
        $quantity = $quote_item->quantity;
        $unitPrice = floatval($this->productPrices[$quoteItemId]['unitPrice'] ?? 0);

        $total = $quantity * $unitPrice;

        $this->productPrices[$quoteItemId]['total'] = round($total, 2);

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

        foreach($this->quote->quote_items as $quote_item) {
            $quote_item->price = $this->productPrices[$quote_item->id]['total'];
            $quote_item->save();
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
