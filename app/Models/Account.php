<?php

namespace App\Models;

use App\Scopes\UserLoginScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['user'];

    protected $attributes = [
        'user_id' => 0
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // use global scope
    protected static function booted()
    {
        static::addGlobalScope(new UserLoginScope);
    }

    // public function scopeUserLogin($query)
    // {
    //     $query->where('user_id', Auth::id());
    // }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
