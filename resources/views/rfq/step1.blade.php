<x-r-f-q-layout>
    <form action="{{ route('rfq.step1.process') }}" method="POST" id="rfqForm">
        @csrf
        <h2 class="text-2xl font-semibold mb-4 text-center">Create RFQ - Step 1</h2>

        <div id="productsContainer">
            <div class="product-entry border p-4 rounded-lg mb-4 bg-gray-100 relative w-full">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-2">
                        <x-input-label for="product" :value="__('Product')"/>
                        <select name="products[0][product_id]" class="productSelect block w-full border-gray-300 rounded" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="unit" :value="__('Unit')" id="unit-format"/>
                        <select name="products[0][unit]" class="block w-full border-gray-300 rounded" required>
                            <option value="">Select Unit</option>
                            <!-- Dynamic options is added by JS -->
                        </select>
                    </div>

                    <div>
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input type="number" name="products[0][quantity]" class="block w-full" required min="1" />
                    </div>

                    <div>
                        <x-input-label for="insulation" :value="__('Insulation')" />
                        <select name="products[0][insulation]" class="block w-full border-gray-300 rounded" required>
                            <option value="Insulated">Insulated</option>
                            <option value="Non-insulated">Non-insulated</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="stand" :value="__('Stand')" />
                        <select name="products[0][stand]" class="block w-full border-gray-300 rounded" required>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-danger mt-4 removeProductBtn  hidden">
                    Remove
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button type="button" id="addProductBtn">
                {{ __('Add More Products') }}
            </x-primary-button>
            <x-primary-button type="submit">
                {{ __('Next Step') }}
            </x-primary-button>
        </div>
    </form>
</x-r-f-q-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let productIndex = 1;

        // Function to update unit options based on selected product
        function updateUnitOptions(productSelect, unitSelect) {
            const selectedProduct = productSelect.selectedOptions[0].text; // Get selected product name
            unitSelect.innerHTML = ""; // Clear existing options

            if (selectedProduct === "GRP Water Tank") {
                // Add options for "GRP Water Tank"
                const options = [
                    "Width x Depth x Height",
                    "1 x 0.5 x 1",
                    "1.5 x 0.5 x 1.5",
                    "2 x 0.5 x 2",
                    "2 x 1 x 2.5",
                    "3 x 1.5 x 2.5",
                    "4 x 1.5 x 2.5",
                    "6 x 3 x 2.8",
                    "8 x 4 x 3.2",
                    "10 x 5 x 4",
                    "15 x 6 x 5.5",
                    "20 x 8 x 6.3",
                    "40 x 15 x 8.3"
                ];

                options.forEach(option => {
                    const optElement = document.createElement("option");
                    optElement.value = option;
                    optElement.textContent = option;
                    unitSelect.appendChild(optElement);
                });
            } else if (selectedProduct === "ENM Water Tank") {
                // Add options for "ENM Water Tank"
                const options = ["m³", "1m³", "2m³", "5m³", "10m³", "15m³", "20m³"];
                options.forEach(option => {
                    const optElement = document.createElement("option");
                    optElement.value = option;
                    optElement.textContent = option;
                    unitSelect.appendChild(optElement);
                });
            } else {
                // Reset the unit options if the product is not GRP or ENM Water Tank
                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Select Unit";
                unitSelect.appendChild(defaultOption);
            }
        }

        // Event listener to add more products
        document.getElementById('addProductBtn').addEventListener('click', function() {
            const container = document.getElementById('productsContainer');
            const newEntry = container.firstElementChild.cloneNode(true);

            // Update the names of the input fields to reflect the new product index
            newEntry.querySelectorAll("input, select").forEach(input => {
                input.name = input.name.replace(/\d+/, productIndex);
                input.value = "";
            });

            // Show the remove button
            newEntry.querySelector('.removeProductBtn').classList.remove('hidden');

            // Add event listener for the product select field in the new entry
            const productSelect = newEntry.querySelector('select[name^="products"][name$="[product_id]"]');
            const unitSelect = newEntry.querySelector('select[name^="products"][name$="[unit]"]');
            productSelect.addEventListener('change', function() {
                updateUnitOptions(productSelect, unitSelect); // Update unit options when product changes
            });

            container.appendChild(newEntry);
            productIndex++;
        });

        // Event listener for removing a product entry
        document.getElementById('productsContainer').addEventListener('click', function(event) {
            if (event.target.classList.contains('removeProductBtn')) {
                if (document.querySelectorAll('.product-entry').length > 1) {
                    event.target.closest('.product-entry').remove();
                }
            }
        });

        // Initialize the unit options for the first product entry (in case it has a pre-selected product)
        const initialProductSelect = document.querySelector('select[name^="products"][name$="[product_id]"]');
        const initialUnitSelect = document.querySelector('select[name^="products"][name$="[unit]"]');
        if (initialProductSelect) {
            updateUnitOptions(initialProductSelect, initialUnitSelect);
            initialProductSelect.addEventListener('change', function() {
                updateUnitOptions(initialProductSelect, initialUnitSelect);
            });
        }
    });
</script>
