<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-black shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 bg-white dark:bg-black border-b border-gray-200 dark:border-gray-700">

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg">
                        <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
                            <th class="py-3 px-4 border-b text-center">{{ __('Company | Project') }}</th>
                            <th class="py-3 px-4 border-b text-center">{{ __('Buyer Name') }}</th>
                            <th class="py-3 px-4 border-b text-center">{{ __('Buyer Phone Number') }}</th>
                            <th class="py-3 px-4 border-b text-center">{{ __('Buyer Email') }}</th>
                            <th class="py-3 px-4 border-b text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                        @if ($requestedQuotes->isEmpty())
                            <tr>
                                <td class="py-3 px-4 border-b text-center text-gray-600 dark:text-gray-300"
                                    colspan="3">
                                    {{ __('No RFQ found') }}
                                </td>
                            </tr>
                        @endif
                        @foreach ($requestedQuotes as $requestedQuote)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="py-3 px-4 border-b text-center text-gray-900 dark:text-white">
                                    {{ $requestedQuote->project->company->name }} | {{ $requestedQuote->project->name }}
                                </td>
                                <td class="py-3 px-4 border-b text-center text-gray-900 dark:text-white">
                                    {{ $requestedQuote->project->contact->name }}
                                </td>
                                <td class="py-3 px-4 border-b text-center text-gray-900 dark:text-white">
                                    {{ $requestedQuote->project->contact->phone_number }}
                                </td>
                                <td class="py-3 px-4 border-b text-center text-gray-900 dark:text-white">
                                    {{ $requestedQuote->project->contact->email }}
                                </td>
                                <td>
                                    <button class="btn btn-primary" wire:click="goToDetail({{$requestedQuote->id}})">View Details</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
