<div class="grid grid-cols-3 gap-6">
    <div class="col-span-1">
        <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-gray-600">Add user</h6>
        <div class="w-full mt-4">
            <form wire:submit.prevent="addUser" class="w-full max-w-lg">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Name
                        </label>
                        <input id="name" type="text" wire:model.debounce.500ms="name"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            placeholder="Name">
                        @error('name') <strong class="text-red-700">{{ $message }}</strong> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            Email
                        </label>
                        <input id="email" type="email" wire:model.debounce.500ms="email"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            placeholder="Email">
                        @error('email') <strong class="text-red-700">{{ $message }}</strong> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="role">
                            Role
                        </label>
                        <div class="relative">
                            <select wire:model="role" id="role"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="role">
                                <option>---</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role') <span class="text-red-700 font-light">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                        <button type="submit"
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="button">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-span-2">
        <h6 class="font-medium leading-tight text-base mt-0 mb-2 text-gray-600">User management</h6>
        <hr>
        <input id="search" type="text" wire:model.lazy="search"
            class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            placeholder="Search">
        <hr>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-2 px-6">#</th>
                    <th scope="col" class="py-4 px-6">Name</th>
                    <th scope="col" class="py-4 px-6">Email</th>
                    <th scope="col" class="py-4 px-6">Role</th>
                    <th scope="col" class="py-4 px-6"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->index + 1 }}
                    </th>
                    <td class="py-4 px-6">{{ $user->name }}</td>
                    <td class="py-4 px-6">{{ $user->email }}</td>
                    <td class="py-4 px-6">{{ $user->role->role_name }}</td>
                    <td class="py-4 px-6">
                        <button wire:click="deleteUser({{ $user->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>