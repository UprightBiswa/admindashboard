<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_date', 'sub_total', 'transaction_id', 'total_amount', 'gst', 'payment_method', 'uuid'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
