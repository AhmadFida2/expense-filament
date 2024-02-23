<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $expenseCategories = [
            "Housing",
            "Transportation",
            "Food",
            "Utilities",
            "Entertainment",
            "Healthcare",
            "Education",
            "Debt",
            "Insurance",
            "Savings",
            "Personal Care",
            "Taxes",
            "Gifts and Donations",
            "Travel",
            "Childcare",
            "Pet Care",
            "Home Maintenance",
            "Clothing",
            "Electronics",
            "Dining Out",
            "Groceries",
            "Hobbies",
            "Subscriptions",
            "Miscellaneous",
        ];

        foreach ($expenseCategories as $category)
        {
            $ex = ExpenseCategory::create([
                'category_name' => $category,
                'user_id' => 1
            ]);
            $ex->save();
        }

        $incomeCategories = [
            "Salary",
            "Freelance Income",
            "Business Income",
            "Rental Income",
            "Investment Income",
            "Interest Income",
            "Dividend Income",
            "Gifts and Inheritance",
            "Alimony",
            "Child Support",
            "Side Gig Income",
            "Social Security",
            "Pension",
            "Retirement Savings Withdrawal",
            "Scholarship/Grants",
            "Royalties",
            "Selling Items",
            "Other Income",
        ];

        foreach ($incomeCategories as $category)
        {
            $ex = IncomeCategory::create([
                'category_name' => $category,
                'user_id' => 1
            ]);
            $ex->save();
        }

        $user = User::create([
            'name' => 'Arslan',
            'email' => 'arslanfida@outlook.com',
            'password' => Hash::make('Arsal2525'),
            'is_active' => true,
        ]);

        $user->save();


    }
}
