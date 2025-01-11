<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        if ($type === 'all') {
            $transactions = Transaction::with('category')->get();
        } else {
            $transactions = Transaction::whereHas('category', function ($query) use ($type) {
                $query->where('type', $type);
            })->with('category')->get();
        }
        return response()->json($transactions);
    }

    public function create()
    {
        $categories = Category::all();
        return view('add-transaction', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $validatedData['user_id'] = auth()->id(); // Automatically set the user ID

        $transaction = Transaction::create($validatedData);
        return redirect()->route('transaction')->with('success', 'Transaction added successfully.');
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
        $query = Transaction::query()->whereHas('category', function ($query) {
            $query->where('type', 'expense');
        });

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
