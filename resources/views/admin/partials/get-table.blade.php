<div class="w-full overflow-hidden rounded-lg shadow-md">
    <table class="w-full bg-white divide-y divide-gray-200">
        <thead class="bg-gray-100 dark:gray-200">
            <tr>
                <th class="py-2 px-4 text-center">Transaction ID</th>
                <th class="py-2 px-4 text-left">Game</th>
                <th class="py-2 px-4 text-left">Username</th>
                <th class="py-2 px-4 text-left">Server</th>
                <th class="py-2 px-4 text-left">Price</th>
                <th class="py-2 px-4 text-center">Status</th>
                <th class="py-2 px-4 text-center">Transaction Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td class="py-2 px-4 text-center bg-slate-200">{{$transaction->id}}</td>
                    <td class="py-2 px-4">{{$transaction->game->name}}</td>
                    <td class="py-2 px-4">{{ $transaction->username }}</td>
                    <td class="py-2 px-4">{{ $transaction->server }}</td>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="bg-white p-4 rounded-md bg-opacity-60 mt-4 w-full">
    {{ $transactions->links() }}
</div>