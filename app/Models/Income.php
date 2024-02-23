<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Income extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'income_date', 'income_amount', 'account_id', 'income_note', 'income_category_id', 'income_sub_category_id'];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function income_category(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class);
    }

    public function income_sub_category(): BelongsTo
    {
        return $this->belongsTo(IncomeSubCategory::class);
    }


}
