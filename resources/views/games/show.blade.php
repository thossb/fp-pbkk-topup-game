@props(['game'])

<x-app-layout>
    <div class="relative">
        <div class="absolute inset-0 opacity-30" style="background-image: url('/images/games/MLBBHeroImage.jpg'); background-size: cover;"></div>
        <div class="min-h-screen flex justify-center relative">
            <div class="bg-none shadow-2xl rounded-lg mx-20 my-20 w-full h-full flex flex-col items-center justify-center relative">
                <div class="bg-white opacity-10 absolute inset-0"></div>
                <div class="flex my-10 z-10">
                    <h1 class="text-3xl font-extrabold text-yellow-main uppercase bg-dark-main p-2 rounded-lg shadow-xl">
                        {{ $game->name }}
                    </h1>
                </div>
                <form action="" method="POST" class="z-10 items-center justify-center flex flex-col" enctype="multipart/form-data">
                    @csrf

                    <div class="flex flex-col z-10 gap-4">
                        <input type="text" name="username" placeholder="Username *" class="rounded-xl" required />
                        <input type="text" name="server" placeholder="Server *" class="rounded-xl" required />
                        <input type="number" name="phone_number" placeholder="No. HP *" class="rounded-xl" required />
                    </div>

                    <!-- Ini nanti ambil dari props game terus di map buat denom atau nominalnya -->
                    <div class="grid grid-cols-4 gap-10 my-10 z-10">
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                        <x-denom-card></x-denom-card>
                    </div>

                    <div class="w-48 z-10 my-10">
                        @php
                        $payments = [
                            ['label' => 'QRIS', 'value' => 'qris'],
                            ['label' => 'Gopay', 'value' => 'gopay'],
                            ['label' => 'Dana', 'value' => 'dana'],
                            ['label' => 'Shopee', 'value' => 'shopee'],
                            ['label' => 'Bank VA', 'value' => 'va'],
                        ];
                        @endphp
                        <label for="payment_method" class="block text-sm font-medium text-white">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md bg-white border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach($payments as $payment)
                                <option value="{{ $payment['value'] }}">{{ $payment['label'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="z-10 mb-10">
                        <x-bladewind.button color="yellow" radius="medium" size="medium">Submit</x-bladewind.button>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
