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
            ['name' => 'Food', 'type' => 'expense'],
            ['name' => 'Grocery', 'type' => 'expense'],
            ['name' => 'Clothing', 'type' => 'expense'],
            ['name' => 'Transportation', 'type' => 'expense'],
            ['name' => 'Health', 'type' => 'expense'],
            ['name' => 'Education', 'type' => 'expense'],
            ['name' => 'Rent', 'type' => 'expense'],
            ['name' => 'Utility', 'type' => 'expense'],
            ['name' => 'Insurance', 'type' => 'expense'],
            ['name' => 'Tax', 'type' => 'expense'],
            ['name' => 'Gift', 'type' => 'expense'],
            ['name' => 'Entertainment', 'type' => 'expense'],
            ['name' => 'Travel', 'type' => 'expense'],
            ['name' => 'Household', 'type' => 'expense'],
            ['name' => 'Personal Care', 'type' => 'expense'],
            ['name' => 'Miscellaneous', 'type' => 'expense'],
            // Income categories
            ['name' => 'Salary', 'type' => 'income'],
            ['name' => 'Business', 'type' => 'income'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Rental Income', 'type' => 'income'],
            ['name' => 'Other', 'type' => 'income'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
