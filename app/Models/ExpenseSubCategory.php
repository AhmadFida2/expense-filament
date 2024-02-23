<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExpenseSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_name','expense_category_id','user_id'];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function expense_category() : BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class)->withoutGlobalScopes();
    }
}
