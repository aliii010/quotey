<?php

namespace App\Livewire\Rfq;

use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Contact;
use App\Models\QuoteItem;
use Livewire\Component;

class Step2 extends Component
{
    public $companyName;
    public $projectName;
    public $location;
    public $fullName;
    public $phoneNumber; //TODO : validation
    public $email;
    public $position;

    protected $rules = [
        'companyName' => 'required|string|max:255',
        'projectName' => 'required|string|max:255|unique:projects,name',
        'location' => 'required|string|max:255',
        'fullName' => 'required|string|max:255',
        'phoneNumber' => 'required|string|max:20',
        'email' => 'required|email|unique:contacts,email',
        'position' => 'required|string|max:255'
    ];
    public function goBack()
    {
        session(['rfq_step2' => [
            'companyName' => $this->companyName,
            'projectName' => $this->projectName,
            'location' => $this->location,
            'fullName' => $this->fullName,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email,
            'position' => $this->position,
        ]]);

        $this->redirect('/rfq/step1', navigate: true);
    }

    public function submitRfq()
    {
        // Begin the transaction
        DB::beginTransaction();

        try {
            $this->validate();

            $step1 = session('rfq_step1');

            $company = Company::firstOrCreate([
                'name' => $this->companyName,
                'location' => $this->location,
            ]);

            $contact = Contact::create([
                'name' => $this->fullName,
                'email' => $this->email,
                'phone_number' => $this->phoneNumber,
                'position' => $this->position,
            ]);

            $project = $company->projects()->create([
                'name' => $this->projectName,
                'contact_id' => $contact->id,
                'company_id' => $company->id
            ]);

            $quote = $project->quotes()->create([
                'project_id' => $project->id,
            ]);

            foreach($step1 as $product)
            {
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'unit' => $product['unit'],
                    'insulation' => $product['insulation'],
                    'stand' => $product['stand'],
                ]);
            }


            DB::commit();

            //TODO : forgetting session doesn't work.
            session()->forget(['rfq_step1', 'rfq_step2']);

            dd("done");

            } catch (\Exception $e) {
                // If any exception occurs, rollback the transaction
                DB::rollBack();

                // Optionally log the error or show a message
                dd("Error: " . $e->getMessage());
            }
        }


    public function mount()
    {
        if (session()->has('rfq_step2')) {
            $this->companyName = session('rfq_step2')['companyName'];
            $this->projectName = session('rfq_step2')['projectName'];
            $this->location = session('rfq_step2')['location'];
            $this->fullName = session('rfq_step2')['fullName'];
            $this->phoneNumber = session('rfq_step2')['phoneNumber'];
            $this->email = session('rfq_step2')['email'];
            $this->position = session('rfq_step2')['position'];
        }
    }

    public function render()
    {
        return view('livewire.rfq.step2');
    }
}
