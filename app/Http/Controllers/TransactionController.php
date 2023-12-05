<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function getMyTransactions()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $transactions = Transaction::with('denom')->with('game')->where('user_id', $user->id)->paginate(5);
        } else {
            $transactions = collect();
        }
        return view('history', compact('transactions'));
    }

    public function getView()
    {
        return view('admin.panel');
    }

    public function getAllTransactions()
    {
        $showListTransactions = true;
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id') // You may want to adjust the ordering
            ->paginate(5);

        return view('admin.panel', compact('transactions', 'showListTransactions'));
    }

    public function getTransactionsData()
    {
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id') // You may want to adjust the ordering
            ->paginate(5);

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
        $transaction->update([
            'status' => $newStatus
        ]);

        // Retrieve updated transactions list
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id')
            ->paginate(5);

        // Render the updated transactions list and return as JSON
        $html = view('admin.partials.get-transactions', compact('transactions'))->render();

        return response()->json(['html' => $html]);
    }

    public function rejectTransaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        // Validate other fields if needed
        $validated = $request->validate([
            'status' => 'required',
        ]);
        // Toggle status based on the current status
        $newStatus = ($transaction->status == 'success' || $transaction->status == 'pending') ? 'failed' : 'success';

        // Update transaction attributes based on $validated data and new status
        $transaction->update([
            'status' => $newStatus
        ]);

        // Retrieve updated transactions list
        $transactions = Transaction::with('denom', 'game')
            ->orderBy('id')
            ->paginate(5);

        // Render the updated transactions list and return as JSON
        $html = view('admin.partials.get-transactions', compact('transactions'))->render();

        return response()->json(['html' => $html]);
    }
}
