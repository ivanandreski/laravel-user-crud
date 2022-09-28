<div class="container mx-auto">
    <div
        class="block mx-auto p-6 w-1/2 mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        @livewire('profile.edit-profile', [], key('edit-profile'))
    </div>
    <div
        class="block mx-auto p-6 w-1/2 mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        @livewire('profile.change-password', [], key('change-password'))
    </div>
    <div
        class="block mx-auto p-6 w-1/2 mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        @livewire('profile.delete-profile', [], key('delete-profile'))
    </div>
</div>