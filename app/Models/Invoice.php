<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'status',
        'amount',
        'billed_date',
        'payed_date',
    ];


    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}
}
