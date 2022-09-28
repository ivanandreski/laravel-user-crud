<div>
    <div class="ms-auto grid grid-cols-2 gap-1">
        <div
            class="block p-6 w-11/12 mx-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <livewire:admin.change-user-role key="{{ now() }}" />
        </div>
        <div
            class="block p-6 w-11/12 mx-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <livewire:admin.manage-roles key="{{ now() }}" />
        </div>
    </div>
    <div class="ms-auto  grid grid-cols-2 gap-1 pl-10 pr-10 mb-5">
        <div
            class="block p-6 col-span-2 w-full mx-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <livewire:admin.user-manager key="{{ now() }}" />
        </div>
    </div>
</div>