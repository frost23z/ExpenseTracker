<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $transactions = [
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Grocery')->first()->id,
                'amount' => 50.00,
                'description' => 'Grocery shopping',
                'transaction_date' => date('Y-m-d', strtotime('-1 week')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Rent')->first()->id,
                'amount' => 100.00,
                'description' => 'Monthly rent',
                'transaction_date' => date('Y-m-d', strtotime('-1 week')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Salary')->first()->id,
                'amount' => 2000.00,
                'description' => 'Salary for October',
                'transaction_date' => date('Y-m-d', strtotime('-1 week')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Transportation')->first()->id,
                'amount' => 75.00,
                'description' => 'Gas for car',
                'transaction_date' => date('Y-m-d', strtotime('-1 month')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Health')->first()->id,
                'amount' => 150.00,
                'description' => 'Doctor visit',
                'transaction_date' => '2023-10-03',
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Freelance')->first()->id,
                'amount' => 500.00,
                'description' => 'Freelance project',
                'transaction_date' => date('Y-m-d', strtotime('-1 month')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'amount' => 200.00,
                'description' => 'New clothes',
                'transaction_date' => date('Y-m-d', strtotime('-1 month')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Other')->first()->id,
                'amount' => 300.00,
                'description' => 'Investment return',
                'transaction_date' => date('Y-m-d', strtotime('-1 month')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Rent')->first()->id,
                'amount' => 120.00,
                'description' => 'Monthly rent',
                'transaction_date' => date('Y-m-d', strtotime('-1 month')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Salary')->first()->id,
                'amount' => 2500.00,
                'description' => 'Salary for this month',
                'transaction_date' => date('Y-m-d', strtotime('-1 year')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Transportation')->first()->id,
                'amount' => 80.00,
                'description' => 'Gas for car',
                'transaction_date' => date('Y-m-d', strtotime('-1 year')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Health')->first()->id,
                'amount' => 160.00,
                'description' => 'Doctor visit',
                'transaction_date' => date('Y-m-d', strtotime('-1 year')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Freelance')->first()->id,
                'amount' => 550.00,
                'description' => 'Freelance project',
                'transaction_date' => date('Y-m-d', strtotime('-1 year')),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'amount' => 220.00,
                'description' => 'New clothes',
                'transaction_date' => date('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Other')->first()->id,
                'amount' => 320.00,
                'description' => 'Investment return',
                'transaction_date' => date('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Grocery')->first()->id,
                'amount' => 70.00,
                'description' => 'Grocery shopping',
                'transaction_date' => date('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'category_id' => $categories->where('name', 'Grocery')->first()->id,
                'amount' => 60.00,
                'description' => 'Grocery shopping',
                'transaction_date' => date('Y-m-d'),
            ],

        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
