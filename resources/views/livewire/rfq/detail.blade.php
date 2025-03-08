<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header with Quote ID and Status -->
        <div class="flex justify-between items-center bg-gradient-to-r from-blue-600 to-ditana px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Quote #{{ $this->numberOfQuoteThisMonth() }} in {{ now()->format('F Y') }}</h2>
            <div class="px-4 py-1 rounded-full text-sm font-medium
                @if($quote->status == 'Approved') bg-green-100 text-green-800
                @elseif($quote->status == 'Pending') bg-yellow-100 text-yellow-800
                @elseif($quote->status == 'Rejected') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ $quote->status }}
            </div>
        </div>

        <div class="p-6">
            <!-- Quote Creation Info -->
            <div class="flex items-center text-gray-500 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Created on {{ date('F j, Y', strtotime($quote->created_at)) }} at {{ date('g:i A', strtotime($quote->created_at)) }}</span>
            </div>

            <!-- Project & Company Card -->
            <div class="bg-gray-50 rounded-xl p-5 mb-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Project & Company Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Project Name</label>
                        <p class="text-gray-900 font-semibold">{{ $quote->project->name }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Company Name</label>
                        <p class="text-gray-900 font-semibold">{{ $quote->project->company->name }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Company Location</label>
                        <p class="text-gray-900 font-semibold">{{ ucfirst($quote->project->company->location) }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Card -->
            <div class="bg-gray-50 rounded-xl p-5 mb-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Contact Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Contact Name</label>
                        <p class="text-gray-900 font-semibold">{{ $quote->project->contact->name }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Position</label>
                        <p class="text-gray-900 font-semibold">{{ $quote->project->contact->position }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Phone Number</label>
                        <p class="text-gray-900 font-semibold">{{ $quote->project->contact->phone_number }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Email Address</label>
                        <p class="text-gray-900 font-semibold">{{ $quote->project->contact->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Quoted Products
                </h3>
                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Insulation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stand</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($quote->products as $product)
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $product->pivot->unit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $product->pivot->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $product->pivot->insulation }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $product->pivot->stand }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                <button class="btn btn-dark mt-4" wire:click="goToIssueQuote({{ $quote->id }})">Issue Quote</button>
            </div>

        </div>
    </div>
</div>
