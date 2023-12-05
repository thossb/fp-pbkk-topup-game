@props(['game', 'denoms'])
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
                <form action="{{ route('transaction.add') }}" method="POST" class="z-10 items-center justify-center flex flex-col" enctype="multipart/form-data">
                    @csrf

                    <div class="flex flex-col z-10 gap-4">
                        <input type="text" name="username" placeholder="Username *" class="rounded-xl" required />
                        <input type="text" name="server" placeholder="Server *" class="rounded-xl" required />
                        <input type="text" name="phone_number" placeholder="No. HP *" class="rounded-xl" required />
                    </div>

                    <!-- Ini nanti ambil dari props game terus di map buat denom atau nominalnya -->
                    <div class="{{ count($denoms) < 4 ? 'flex' : 'grid grid-cols-4' }} gap-10 my-10 z-10">
                        @foreach ($denoms as $denom)
                            <x-denom-card :denom="$denom" :game="$game"></x-denom-card>
                        @endforeach
                    </div>                    
                    
                    <input type="hidden" name="denom_id" id="selected_denom_id" value="" required>
                    <input type="hidden" name="game_id" id="selected_game_id" value="" required>

                    <div class="flex gap-10">
                        <div id="cart" class="p-4 border rounded-md bg-white opacity-70 w-96 flex flex-col gap-3 mb-10 h-48">
                            <h2 class="text-lg font-semibold self-center">Order Preview</h2>
                            <ul id="cart-items"></ul>
                        </div>
                        
                        <div class="w-96 hover:brightness-75">
                            <label
                                class="flex flex-col justify-center w-full h-48 px-4 transition bg-white opacity-70 border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                            >
                                <span class="flex items-center justify-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span id="fileInfo" class="font-semibold text-black">
                                        Upload Payment Proof
                                    </span>
                                </span>
                                <input id="paymentProofInput" type="file" name="payment_proof" class="hidden" onchange="updateFileInfo()" required>
                            </label>
                        </div>
                        
                        <script>
                            function updateFileInfo() {
                                const fileInput = document.getElementById('paymentProofInput');
                                const fileInfo = document.getElementById('fileInfo');
                        
                                if (fileInput.files.length > 0) {
                                    const fileName = fileInput.files[0].name;
                                    const fileSize = (fileInput.files[0].size / (1024 * 1024)).toFixed(2); // Convert to MB
                        
                                    fileInfo.innerHTML = `
                                        <span class="text-green-500">${fileName}</span>
                                        <span class="text-gray-500">(${fileSize} MB)</span>
                                    `;
                                } else {
                                    fileInfo.innerHTML = 'Upload Payment Proof';
                                }
                            }
                        </script>
                        
                    </div>

                    <div class="flex items-center justify-center gap-3 mt-10 mb-10">
                        <div class="w-48 z-10">
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
    
                        <div class="z-10">
                            <x-bladewind.button size="small" class="mt-6 bg-yellow-400 rounded-lg font-semibold hover:scale-105 hover:brightness-50 transition delay-75" can_submit="true">Submit</x-bladewind.button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        let selectedDenom;
        let selectedGame;
    
        function addToCart(event, denom, game) {
            event.preventDefault();
            selectedDenom = denom;
            selectedGame = game;
            document.getElementById('selected_denom_id').value =  selectedDenom.id;
            document.getElementById('selected_game_id').value = selectedGame.id;
            // document.getElementById('selected_denom_id').value =  $('input["selectedDenom"]').val(true);
            // document.getElementById('selected_game_id').value = $('input["selectedGame"]').val(true);
            // console.log('Selected Denom:', selectedDenom.id, 'test babi',  document.getElementById('selected_denom_id').value);
            // console.log('Selected Game:', selectedGame.id, 'test babibum', document.getElementById('selected_game_id').value);
            gameUnit = game.unit;
            updateCartDisplay(gameUnit);
        }
    
        function updateCartDisplay(unit) {
        const cartContainer = document.getElementById('cart-items');
        cartContainer.innerHTML = '';

        if (selectedDenom) {
            const table = document.createElement('table');
            table.classList.add('min-w-full', 'divide-y', 'divide-gray-200');

            // Create table header
            const thead = document.createElement('thead');
            thead.classList.add('bg-gray-50');
            const headerRow = document.createElement('tr');
            const headers = ['Denom', 'Quantity', 'Price'];
            headers.forEach(headerText => {
                const th = document.createElement('th');
                th.classList.add('px-6', 'py-3', 'text-left', 'text-xs', 'font-medium', 'text-gray-500', 'uppercase', 'tracking-wider');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Create table body
            const tbody = document.createElement('tbody');
            const row = document.createElement('tr');
            const denomCell = document.createElement('td');
            denomCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');
            denomCell.textContent = selectedDenom.denom;
            row.appendChild(denomCell);

            const quantityCell = document.createElement('td');
            quantityCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');
            quantityCell.textContent = '1'; // Assuming quantity is always 1
            row.appendChild(quantityCell);

            const priceCell = document.createElement('td');
            priceCell.classList.add('px-6', 'py-4', 'whitespace-nowrap');
            priceCell.textContent = `Rp. ${selectedDenom.price}`;
            row.appendChild(priceCell);

            tbody.appendChild(row);
            table.appendChild(tbody);

            cartContainer.appendChild(table);
            }
        }
    </script>
    @endpush
</x-app-layout>
