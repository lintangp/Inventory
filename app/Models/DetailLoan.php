<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLoan extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'inventory_id',
        'loan_id',
        'sum',
    ];  

    
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
