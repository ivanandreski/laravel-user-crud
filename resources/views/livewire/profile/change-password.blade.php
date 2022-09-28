<div class="w-full max-w-sm">
    <form wire:submit.prevent="saveChanges">
        <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-gray-600">Change password</h6>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="currentPassword">
                    Current Password
                </label>
            </div>
            <div class="md:w-2/3">
                <input id="currentPassword" type="password" wire:model.debounce.500ms="currentPassword"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">
                    New Password
                </label>
            </div>
            <div class="md:w-2/3">
                <input id="password" type="password" wire:model.debounce.500ms="password"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                    for="password_confirmation">
                    Confirm New Password
                </label>
            </div>
            <div class="md:w-2/3">
                <input id="password_confirmation" type="password" wire:model.debounce.500ms="password_confirmation"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

                @error('password') <h6 class="text-red-700 font-light">{{ $message }}</h6> @enderror
                @error('password_confirmation') <h6 class="text-red-700 font-light">{{ $message }}</h6> @enderror
                <h6 class="text-red-700 font-light">{{ $currentPasswordError }}</h6>
                <h6 class="text-green-700 font-light">{{ $successMessage }}</h6>
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