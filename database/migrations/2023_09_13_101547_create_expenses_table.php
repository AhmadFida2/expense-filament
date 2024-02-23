<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('expense_date');
            $table->decimal('expense_amount',12,2);
            $table->foreignId('account_id');
            $table->text('expense_note')->nullable();
            $table->foreignId('expense_category_id');
            $table->foreignId('expense_sub_category_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
