<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';

    // Fields that are mass assignable
    protected $fillable = [
        'employee_id',
        'salary',
        'bonuses',
        'deductions',
        'net_salary',
        'pay_date',
    ];

    // Define the relationship to the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
