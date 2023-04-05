<?php

namespace App\Models;

use App\Scopes\UserLoginScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['account'];

    protected static function booted()
    {
        static::addGlobalScope(new UserLoginScope);
    }

    public function scopeAccountType($query, $type)
    {
        $query->when($type, function ($query, $type) {
            return $query->whereHas('account', function ($query) use ($type) {
                $query->where('type', $type);
            });
        });
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function cash_recap()
    {
        return $this->belongsTo(CashRecap::class, 'cash_recap_id');
    }
}
