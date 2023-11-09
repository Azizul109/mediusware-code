<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function showAllTransactions()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->get();
        $balance = $user->balance;

        return view('transactions', compact('transactions', 'balance'));
    }

    public function showDeposits()
    {
        $user = Auth::user();
        $deposits = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'deposit')
            ->get();

        return view('show-deposit', compact('deposits'));
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'amount' => 'required|numeric|min:0',
        ]);

        // Find the user by email
        $user = User::where('email', $request->input('email'))->first();

        // Update user balance
        $user->balance += $request->input('amount');
        $user->save();

        // Record the deposit transaction
        Transaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'deposit',
            'amount' => $request->input('amount'),
            'date' => now(),
        ]);

        return redirect('/deposit')->with('success', 'Deposit successful');
    }

    public function showWithdrawals()
    {
        $user = Auth::user();
        $withdrawals = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'withdrawal')
            ->get();

        return view('show-withdraw', compact('withdrawals'));
    }

    public function withdraw(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        // Check withdrawal conditions based on account type
        $withdrawalFeeRate = ($user->account_type == 'individual') ? 0.015 : 0.025;

        // Check if it's Friday (free withdrawal day for Individual accounts)
        $isFriday = Carbon::now()->dayOfWeek == Carbon::FRIDAY;

        // Check if it's the first withdrawal of the month for Individual accounts
        $isFirstWithdrawalOfMonth = $user->transactions()->where('transaction_type', 'withdrawal')->count() == 0;

        // Check if the total withdrawal amount is less than or equal to 50K for Business accounts
        $totalWithdrawal = $user->transactions()->where('transaction_type', 'withdrawal')->sum('amount');
        $isBusinessFreeWithdrawal = ($user->account_type == 'business' && $totalWithdrawal <= 50000);

        // Determine if the withdrawal is free based on the conditions
        $isFreeWithdrawal = ($user->account_type == 'individual' && ($isFriday || $isFirstWithdrawalOfMonth))
            || $isBusinessFreeWithdrawal;

        // Apply withdrawal fee if it's not a free withdrawal
        $withdrawalFee = $isFreeWithdrawal ? 0 : $request->input('amount') * $withdrawalFeeRate;
        $netWithdrawalAmount = $request->input('amount') - $withdrawalFee;

        // Update user balance
        $user->balance -= $netWithdrawalAmount;
        $user->save();

        // Record the withdrawal transaction
        Transaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'withdrawal',
            'amount' => $netWithdrawalAmount,
            'fee' => $withdrawalFee,
            'date' => now(),
        ]);

        return redirect('/withdraw')->with('success', 'Withdrawal successful');
    }
}
