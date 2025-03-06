<div  class="flex justify-center items-center h-screen">
    <form wire:submit.prevent="submitRfq" class="w-1/2 space-y-4">
        <h2 class="text-2xl font-semibold mb-4 text-center">Create RFQ - Step 2</h2>

        <div>
            <x-input-label for="company_name" :value="__('Company Name')" />
            <x-text-input type="text" wire:model="companyName" class="block w-full" required />
            @error('companyName')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="project_name" :value="__('Project Name')" />
            <x-text-input type="text" wire:model="projectName" class="block w-full" required />
            @error('projectName')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="location" :value="__('Location')" />
            <select wire:model="location" class="block w-full border-gray-300 rounded">
                <option value="">Select City</option>
                <option value="erbil">Erbil</option>
                <option value="al-anbar">Al Anbar</option>
                <option value="al-muthanna">Al Muthanna Governorate</option>
                <option value="al-qadisiyad">Al Qadisiyah / Al Diwaniyah</option>
                <option value="an-najaf">An Najaf</option>
                <option value="baghdad">Baghdad</option>
                <option value="basra">Basra</option>
                <option value="babil">Babil</option>
                <option value="dhi-qar">Dhi Qar</option>
                <option value="diyala">Diyala</option>
                <option value="duhok">Duhok</option>
                <option value="halabja">Halabja Governorate</option>
                <option value="karbala">Karbala</option>
                <option value="kirkuk">Kirkuk</option>
                <option value="maysan">Maysan</option>
                <option value="nineveh">Nineveh</option>
                <option value="salah-ad-din">Salah ad Din</option>
                <option value="sulaymaniyah">Sulaymaniyah</option>
                <option value="wasit">Wasit</option>
            </select>
            @error('location')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="full-name" :value="__('Your Full Name')" />
            <x-text-input type="text" wire:model="fullName" class="block w-full" required />
            @error('fullName')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input type="email" wire:model="email" class="block w-full" required />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input type="tel" wire:model="phoneNumber" class="block w-full" required />
            @error('phoneNumber')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="text" :value="__('Position')" />
            <x-text-input type="text" wire:model="position" class="block w-full" required />
            @error('position')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex items-center justify-end mt-4 gap-4">
            <x-primary-button type="button" wire:click="goBack">
                {{ __('Back') }}
            </x-primary-button>
            <x-primary-button type="submit">
                {{ __('Submit RFQ') }}
            </x-primary-button>
        </div>
    </form>
</div>
