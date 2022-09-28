<div>
    <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-gray-600">Role management</h6>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-2 px-6">#</th>
                <th scope="col" class="py-4 px-6">Name</th>
                <th scope="col" class="py-4 px-6"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->index + 1 }}
                </th>
                <td class="py-4 px-6">{{ $role->role_name }}</td>
                <td class="py-4 px-6">
                    <button wire:click="deleteRole({{ $role->id }})"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr />
    <div class="w-full max-w-sm mt-4">
        <form wire:submit.prevent="addNewRole">
            <div class="md:flex md:items-center mb-6">
                <div>
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="role">
                        Role
                    </label>
                </div>
                <div>
                    <input id="role" type="text" wire:model.debounce.500ms="newRole"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div>
                    <button type="submit"
                        class="ml-2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="button">
                        Add Role
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>