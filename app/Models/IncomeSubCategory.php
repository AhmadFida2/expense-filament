<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomeSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_name','income_category_id','user_id'];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function income_category() : BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class)->withoutGlobalScopes();
    }
}
