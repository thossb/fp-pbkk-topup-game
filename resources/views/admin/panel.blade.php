<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <section class="flex flex-col gap-10 mx-20 py-10 items-center justify-center z-20">
        <div class="bg-slate-100 rounded-xl flex flex-col gap-4 py-4 px-10">
            <h1 class="text-black text-xl font-semibold text-center">Query</h1>
            <div class="grid grid-cols-3 gap-10">
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Create Game</x-bladewind.button>
                    {{-- <x-danger-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    >{{ __('Delete Account') }}</x-danger-button>

                    <x-modal name="" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('user.delete', ['id' => $user->id]) }}" class="p-6">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mt-6">
                                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                />

                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ml-3">
                                    {{ __('Delete Account') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal> --}}
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Edit Game</x-bladewind.button>
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Delete Game</x-bladewind.button>
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Create Denom</x-bladewind.button>
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Edit Denom</x-bladewind.button>
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Delete Denom</x-bladewind.button>
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100" onclick="showTable('{{route('admin.get-transactions')}}')" >Transaction List</x-bladewind.button>
                {{-- onclick="showTable('{{route('admin.get-transactions')}}')" --}}
                {{-- <input type="hidden" value="{{route('admin.get-transactions')}}"> --}}
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">User List</x-bladewind.button>
                <x-bladewind.button radius="medium" color="black" class="hover:brightness-50 hover:scale-95 transition delay-100">Game List</x-bladewind.button>
            </div>
        </div>
        <div id="transaction-list-container" class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="bg-slate-100" id="render-data">

                {{-- render data --}}
            </div>
        </div>
    </section>

    @push('scripts')
    <script>


    async function showTable(url) {
        try {   
            // Make an AJAX request to the specified URL
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);

            }

            // Assuming 'data' contains the transactions data
            const data = await response.json();

            // Update the content of the desired HTML element with the received data
            document.getElementById('transaction-list-container').innerHTML = data.html;
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function updateTransactionStatus(status, url) {
        try {
            // Make an AJAX request to update the transaction
            const response = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ status: status }), // Use the provided status parameter
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            // Parse the response if it's JSON
            const data = await response.json();

            // Assuming 'data' contains the updated transactions data
            // Update the content of the table with the received data
            document.getElementById('transaction-list-container').innerHTML = data.html;
        } catch (error) {
            console.error('Error:', error);

            // Log the response text if available
            response.text().then(text => console.error('Response text:', text));

            // Handle the error, e.g., display an error message to the user
            // You can customize this part based on your needs
        }
    }

    async function rejectTransactionStatus(status, url) {
        try {
            // Make an AJAX request to update the transaction
            const response = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ status: status }), // Use the provided status parameter
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            // Parse the response if it's JSON
            const data = await response.json();

            // Assuming 'data' contains the updated transactions data
            // Update the content of the table with the received data
            document.getElementById('transaction-list-container').innerHTML = data.html;
        } catch (error) {
            console.error('Error:', error);

            // Log the response text if available
            response.text().then(text => console.error('Response text:', text));

            // Handle the error, e.g., display an error message to the user
            // You can customize this part based on your needs
        }
    }

    
    </script>


    @endpush    
</x-app-layout>