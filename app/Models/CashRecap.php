<?php

namespace App\Models;

use App\Scopes\UserLoginScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRecap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'year_month' => 'datetime:Y-m'
    ];

    // global scope - user login / active
    protected static function booted()
    {
        static::addGlobalScope(new UserLoginScope);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
