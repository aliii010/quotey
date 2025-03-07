<?php

namespace App\Livewire\Rfq;

use App\Models\Quote;
use Livewire\Component;

class Detail extends Component
{
    public $quote;

    public function numberOfQuoteThisMonth()
    {
        return Quote::whereMonth('created_at', now()->month)->count();
    }

    public function mount($id)
    {
        $this->quote = Quote::find($id);
    }

    public function render()
    {
        return view('livewire.rfq.detail');
    }
}
