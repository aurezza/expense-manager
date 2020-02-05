<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;  
    protected $dates = ['deleted_at'];  
    protected $fillable = [
        'user_id', 'category_id', 'amount', 'entry_date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\ExpenseCategory');
    }
}
