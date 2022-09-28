<div class="w-full max-w-sm">
    <form wire:submit.prevent="saveChanges">
        <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-gray-600">Edit details</h6>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                    Name
                </label>
            </div>
            <div class="md:w-2/3">
                <input id="inline-full-name" type="text" wire:model.debounce.500ms="name"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

                @error('name') <span class="text-red-700 font-light">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                    Email
                </label>
            </div>
            <div class="md:w-2/3">
                <input id="email" type="email" wire:model.debounce.500ms="email"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

                @error('email') <span class="text-red-700 font-light">{{ $message }}</span> @enderror
                <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-green-600">{{ $successMessage }}</h6>
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button type="submit"
                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="button">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>