<div class="w-full max-w-sm">
    <form wire:submit.prevent="saveChanges" class="w-full">
        <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-gray-600">Edit user role</h6>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                    Email
                </label>
            </div>
            <div class="md:w-2/3">
                <input id="inline-full-name" type="email" wire:model.debounce.500ms="userEmail"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="role">
                    Role
                </label>
            </div>
            <div class="md:w-2/3">
                <select wire:model="userRole"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>---</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <strong class="text-red-700 font-light">{{ $errorMessage }}</strong>
            </div>
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