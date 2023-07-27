<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'loan_date',
        'return_date',
        'status',
        'employee_id'
    ];  

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
