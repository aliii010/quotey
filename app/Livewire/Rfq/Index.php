<?php

namespace App\Livewire\Rfq;

use App\Models\Quote;
use Livewire\Component;

class Index extends Component
{
    public $requestedQuotes;

    public function goToDetail($id)
    {
        $this->redirect('rfq/' . $id, navigate: true);
    }

    public function mount()
    {
        $this->requestedQuotes = Quote::where('status', 'requested')->get();
    }
    public function render()
    {
        return view('livewire.rfq.index');
    }
}
