<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',  'payment_date', 'sub_total', 'transaction_id', 'total_amount', 'gst', 'payment_method'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->uuid = Str::uuid();
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
