<div  class="flex justify-center items-center h-screen">
    <form wire:submit.prevent="submit">
        <h2 class="text-2xl font-semibold mb-4 text-center">Create RFQ - Step 1</h2>

        <div id="productsContainer">
            @foreach($products as $index => $product)
                <div class="product-entry border p-4 rounded-lg mb-4 bg-gray-100 relative w-full">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-2">
                            <x-input-label for="product{{ $index }}" :value="__('Product')"/>
                            <select
                                wire:model="products.{{ $index }}.product_id"
                                class="block w-full border-gray-300 rounded"
                                required
                            >
                                <option value="">Select Product</option>
                                @foreach($allProducts as $productOption)
                                    <option value="{{ $productOption->id }}">{{ $productOption->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="unit{{ $index }}" :value="__('Unit')" />
                            <x-text-input type="text" wire:model="products.{{ $index }}.unit" class="block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="quantity{{ $index }}" :value="__('Quantity')" />
                            <x-text-input
                                type="number"
                                wire:model="products.{{ $index }}.quantity"
                                class="block w-full"
                                required
                                min="1"
                            />
                        </div>

                        <div>
                            <x-input-label for="insulation{{ $index }}" :value="__('Insulation')" />
                            <select
                                wire:model="products.{{ $index }}.insulation"
                                class="block w-full border-gray-300 rounded"
                                required
                            >
                                <option value="Insulated">Insulated</option>
                                <option value="Non-insulated">Non-insulated</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="stand{{ $index }}" :value="__('Stand')" />
                            <select
                                wire:model="products.{{ $index }}.stand"
                                class="block w-full border-gray-300 rounded"
                                required
                            >
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    @if(count($products) > 1)
                        <button type="button" wire:click="removeProduct({{ $index }})" class="btn btn-danger mt-4">
                            Remove
                        </button>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button type="button" wire:click="addProduct">
                {{ __('Add More Products') }}
            </x-primary-button>
            <x-primary-button type="submit">
                {{ __('Next Step') }}
            </x-primary-button>
        </div>
    </form>
</div>
