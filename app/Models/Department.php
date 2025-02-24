<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Define the table name if it's not plural
    protected $table = 'departments';

    // Define the fillable attributes (columns that can be mass-assigned)
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    // Optionally, define the timestamps if your table uses them
    public $timestamps = true;

    // You can also define the date format for the timestamps if necessary
    // protected $dateFormat = 'Y-m-d H:i:s';
}