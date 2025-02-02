<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'name', 
        'phone',
        'nic_no', 
        'type', 
        'address', 
        'date',
        'status',
        'is_available',
    ];

    protected static function booted()
    {
        static::saving(function ($worker) {
            if ($worker->is_available) {
                $worker->status = 'Available';
            } else if (!$worker->is_available) {
                $worker->status = 'Unavailable';
            }
        });
    }
}
