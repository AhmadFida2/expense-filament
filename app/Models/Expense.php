<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sushi\Sushi;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','expense_date','expense_amount','account_id','expense_note','expense_category_id','expense_sub_category_id'];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function expense_category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function expense_sub_category(): BelongsTo
    {
        return $this->belongsTo(ExpenseSubCategory::class);
    }


}
