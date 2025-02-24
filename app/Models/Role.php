<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'title',
        'description',
    ];

    // If you want to include soft deletes
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    // Define a relationship to the Employee model (if you want to access the employees with a certain role)
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}