<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-7 gap-4">
                <div class="col-span-7 sm:col-span-2">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="height: 100%;">
                        <div class="max-w-4xl">
                            @include('admin.partials.update-profile-picture-information-form')
                        </div>
                    </div>
                </div>
                <div class="col-span-7 sm:col-span-5">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="height: 100%;">
                        <div class="max-w-4xl">
                            @include('admin.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
