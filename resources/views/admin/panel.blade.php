<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <section class="flex flex-col gap-4 mx-20 py-10 items-center justify-center z-20">
        @include('admin.partials.get-table')
    </section>
</x-app-layout>
