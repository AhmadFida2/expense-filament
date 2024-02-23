<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sushi\Sushi;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','account_number','account_type','opening_balance'];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function running_balance() : float
    {
        $expenses = Expense::where('account_id',$this->id)->sum('expense_amount');
        $incomes = Income::where('account_id',$this->id)->sum('income_amount');
        return $this->opening_balance + $incomes - $expenses;
    }

    public function expenses() : HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function incomes() : HasMany
    {
        return $this->hasMany(Income::class);
    }

}
