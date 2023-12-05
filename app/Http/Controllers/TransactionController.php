<?php

namespace App\Http\Controllers;

use App\Jobs\OrderNotificationJob;
use App\Models\Game;
use App\Models\GameDenom;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function getMyTransactions(Request $request)
    {
        $user = Auth::user();
        $pagination = 5;

        $query = Transaction::with('denom', 'game')->where('user_id', $user->id);

        // Sorting options
        $sortBy = $request->input('sort_by', 'id'); // Default sorting by ID
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting in ascending order

        // Validate sorting parameters to prevent SQL injection
        $validSortColumns = ['id', 'username', 'server', 'phone_number', 'payment_method', 'status'];
        $sortBy = in_array($sortBy, $validSortColumns) ? $sortBy : 'id';
        $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

        $transactions = $query->orderBy($sortBy, $sortOrder)->paginate($pagination);

        return view('history', compact('transactions', 'sortBy', 'sortOrder'));
    }

    public function getView()
    {
        return view('admin.panel');
    }

    public function getAllTransactions()
    {
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id') // You may want to adjust the ordering
            ->paginate(5);

        return view('admin.panel', compact('transactions'));
    }

    public function getTransactionsData()
    {
        $transactions = Transaction::with('denom', 'game', 'user')
            ->orderBy('id')->get(); // You may want to adjust the ordering
        // ->paginate(5);

        $html = view('admin.partials.get-transactions', compact('transactions'))->render();

        return response()->json(['html' => $html]);
    }

    public function createTransaction(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
        }
        $validated = $request->validate([
            'username' => 'required|string|max:30',
            'server' => 'required|string|max:30',
            'phone_number' => 'required|string|max:20',
            'payment_method' => 'required',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'game_id' => 'required',
            'denom_id' => 'required',
        ]);

        $imagePath = $request->file('payment_proof')->store('payment_proofs', 'public');

        $transaction = Transaction::create([
            'username' => $validated['username'],
            'server' => $validated['server'],
            'phone_number' => $validated['phone_number'],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $imagePath,
            'game_id' => $validated['game_id'],
            'denom_id' => $validated['denom_id'],
            'status' => 'pending',
            'user_id' => $user->id
        ]);
        // dd($transaction);
        return redirect()->route('dashboard')->with('success', 'Your transaction has been posted. Please wait for confirmation.');
    }

    public function updateTransaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        // Validate other fields if needed
        $validated = $request->validate([
            'status' => 'required',
        ]);

        // Toggle status based on the current status
        $newStatus = ($transaction->status == 'pending') ? 'succeed' : 'pending';

        // Update transaction attributes based on $validated data and new status
        if ($newStatus == 'succeed') {
            info('damnbruh');
            $user = User::find($transaction->user_id);
            if ($user) {
                $email = $user->email;
                $user_name = $user->name;
                $game = Game::where('id', $transaction->game_id)->first();
                $denom = GameDenom::where('id', $transaction->denom_id)->first();

                OrderNotificationJob::dispatch($email, $user_name, $transaction->created_at, $transaction->id, $game->name, $game->unit, $denom->denom, $denom->price);
            }
        }

        $transaction->update([
            'status' => $newStatus
        ]);



        // Retrieve updated transactions list
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id')->get();


        $html = view('admin.partials.get-transactions', compact('transactions'))->render();

        return response()->json(['html' => $html]);
        // return view('admin.panel')->with('test');
    }

    public function rejectTransaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        // Validate other fields if needed
        $validated = $request->validate([
            'status' => 'required',
        ]);
        // Toggle status based on the current status
        $newStatus = ($transaction->status == 'succeed' || $transaction->status == 'pending') ? 'failed' : 'succeed';

        // Update transaction attributes based on $validated data and new status
        $transaction->update([
            'status' => $newStatus
        ]);

        // Retrieve updated transactions list
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id')->get();

        // Render the updated transactions list and return as JSON
        $html = view('admin.partials.get-transactions', compact('transactions'))->render();

        return response()->json(['html' => $html]);
    }
}
