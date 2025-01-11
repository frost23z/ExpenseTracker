<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Expense categories
            ['name' => 'Food', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Grocery', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Clothing', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Transportation', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Health', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Education', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Rent', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Utility', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Insurance', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Tax', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Gift', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Investment', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Savings', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Debt', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Entertainment', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Travel', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Household', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Personal Care', 'type' => 'expense', 'is_custom' => false],
            ['name' => 'Miscellaneous', 'type' => 'expense', 'is_custom' => false],
            // Income categories
            ['name' => 'Salary', 'type' => 'income', 'is_custom' => false],
            ['name' => 'Business', 'type' => 'income', 'is_custom' => false],
            ['name' => 'Investment', 'type' => 'income', 'is_custom' => false],
            ['name' => 'Other', 'type' => 'income', 'is_custom' => false],
            ['name' => 'Freelance', 'type' => 'income', 'is_custom' => false],
            ['name' => 'Rental Income', 'type' => 'income', 'is_custom' => false],
            ['name' => 'Interest', 'type' => 'income', 'is_custom' => false],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
