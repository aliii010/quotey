<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header with Quote ID and Status -->
        <div class="flex justify-between items-center bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Issue Quote #{{ $quote->id }}</h2>
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
                        <p class="text-gray-900 font-semibold">{{ $quote->project->company->location }}</p>
                    </div>
                </div>
            </div>

            <!-- Pricing Form Section -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Product Pricing
                    </h3>
                </div>

                <form wire:submit.prevent="issueQuote">
                    <div class="overflow-x-auto rounded-xl border border-gray-200 mb-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specifications</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price ($)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount (%)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($quote->quote_items as $quote_item)
                                <tr class="hover:bg-blue-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $quote_item->product->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600">
                                            <div>Unit: {{ $quote_item->unit }}</div>
                                            <div>Insulation: {{ $quote_item->insulation }}</div>
                                            <div>Stand: {{ $quote_item->stand }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ $quote_item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <input
                                                type="number"
                                                step="0.01"
                                                min="0"
                                                wire:keydown.enter.prevent
                                                wire:model="productPrices.{{ $quote_item->id }}.unitPrice"
                                                wire:input="calculateTotal({{ $quote_item->id }})"
                                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                                placeholder="0.00"
                                            >
                                            @error('productPrices.' . $quote_item->id . '.unitPrice')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="relative rounded-md shadow-sm">
                                            <input
                                                type="number"
                                                step="0.1"
                                                min="0"
                                                max="100"
                                                wire:keydown.enter.prevent
                                                wire:model="productPrices.{{ $quote_item->id }}.discount"
                                                wire:input="calculateTotal({{ $quote_item->id }})"
                                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md"
                                                placeholder="0"
                                            >
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">
                                        $<span wire:key="total-{{ $quote_item->id }}">{{ number_format($productPrices[$quote_item->id]['total'] ?? 0, 2) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="4" class="px-6 py-4"></td>
                                <td class="px-6 py-3 text-right text-sm font-bold text-gray-700">Grand Total:</td>
                                <td class="px-6 py-3 text-left font-bold text-lg text-blue-600">${{ number_format($grandTotal ?? 0, 2) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>


                    <!-- Notes Section -->
                    <div class="bg-gray-50 rounded-xl p-5 mb-6 border border-gray-100">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                        <textarea
                            id="notes"
                            rows="3"
                            wire:model="notes"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Additional information, terms, or conditions..."
                        ></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button
                            type="button"
                            wire:click="cancel"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Issue Quote
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

