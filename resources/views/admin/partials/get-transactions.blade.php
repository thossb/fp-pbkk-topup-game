<table class="w-full bg-white divide-y divide-gray-200">
    <thead class="bg-gray-100 dark:gray-200">
        <tr>
            <th class="py-2 px-4 text-center">Transaction ID</th>
            <th class="py-2 px-4 text-left">Game</th>
            <th class="py-2 px-4 text-left">Denom</th>
            <th class="py-2 px-4 text-left">Price</th>
            <th class="py-2 px-4 text-center">Status</th>
            <th class="py-2 px-4 text-center">Transaction Date</th>
            <th class="py-2 px-4 text-center">Query</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td class="py-2 px-4 text-center bg-slate-200">{{$transaction->id}}</td>
                <td class="py-2 px-4">{{$transaction->game->name}}</td>
                <td class="py-2 px-4">{{$transaction->denom->denom}} {{$transaction->game->unit}}</td>
                <td class="py-2 px-4">Rp. {{ $transaction->denom->price }}</td>
                <td class="py-2 px-4 text-center bg-slate-100">
                    <span class="status-badge py-1 px-5 rounded-md text-white font-semibold
                                @if($transaction->status === 'pending') bg-yellow-500
                                @elseif($transaction->status === 'succeed') bg-green-500
                                @elseif($transaction->status === 'failed') bg-red-500
                                @endif">
                        {{ $transaction->status }}
                    </span>
                </td>
                <td class="py-2 px-4 bg-slate-200 text-center">{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                <td class="py-2 px-4 text-center flex justify-between gap-3 h-20">
                    <button class="validate-button bg-blue-300 px-4 py-2 w-28 rounded-lg hover:border-dashed hover:border-2 hover:border-black transition delay-100 hover:scale-95 hover:brightness-95" >
                        {{-- onclick="updateTransactionStatus('{{ $transaction->status }}', '{{route('admin.update', ['id' => $transaction->id])}}')" --}}
                        @if($transaction->status === 'succeed')
                            Unvalidate
                        @else
                            Validate
                        @endif
                    </button>
                    <button class="validate-button bg-purple-300 px-4 py-2 w-28 rounded-lg hover:border-dashed hover:border-2 hover:border-black transition delay-100 hover:scale-95 hover:brightness-95" data-transaction-id="{{ $transaction->id }}" data-status="{{ $transaction->status }}">
                        Reject
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="bg-white p-4 rounded-md bg-opacity-60 mt-4 w-full">
    {{ $transactions->links() }}
</div>

<script>
// Define the updateTransactionStatus function
function updateTransactionStatus(status, url) {
    fetch(url, {
    method: 'PATCH',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
    },
    body: JSON.stringify({ status: status }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the response if it's JSON
        return response.json();
    })
    .then(data => {
        // Assuming 'data' contains the updated transactions data
        // Update the content of the table with the received data
        document.getElementById('transaction-list-container').innerHTML = data.html;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>