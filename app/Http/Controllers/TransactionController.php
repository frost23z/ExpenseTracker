<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        if ($type === 'all') {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('type', $type)->get();
        }
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
            'type' => 'required|in:income,expense',
        ]);

        $transaction = Transaction::create($validatedData);
        return response()->json($transaction, 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
            'type' => 'required|in:income,expense',
        ]);

        $transaction->update($validatedData);
        return response()->json($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }

    public function summary(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $query = Transaction::query()->where('type', 'expense');

        if ($startDate) {
            $query->whereDate('transaction_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('transaction_date', '<=', $endDate);
        }

        $totalAmount = $query->sum('amount');

        $summary = $query->selectRaw('category_id, SUM(amount) as total')
                         ->groupBy('category_id')
                         ->with('category')
                         ->orderBy('total', 'desc')
                         ->get()
                         ->map(function ($item) use ($totalAmount) {
                             return [
                                 'category' => $item->category->name,
                                 'total' => $item->total,
                                 'percentage' => $totalAmount > 0 ? ($item->total / $totalAmount) * 100 : 0
                             ];
                         });

        $topCategories = $summary->take(10);
        $otherCategories = $summary->slice(10);
        $otherTotal = $otherCategories->sum('total');

        if ($otherTotal > 0) {
            $topCategories->push([
                'category' => 'Others',
                'total' => $otherTotal,
                'percentage' => $totalAmount > 0 ? ($otherTotal / $totalAmount) * 100 : 0
            ]);
        }

        return response()->json($topCategories);
    }
}
