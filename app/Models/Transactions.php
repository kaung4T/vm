<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userId',
        'productId',
    ];

    public function User ()  {
        return $this->hasOne('App\Models\User', 'id', 'userId');
    }

    public function Product ()  {
        return $this->hasOne('App\Models\Products', 'id', 'productId');
    }
}
