<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 'service_id', 'quantity', 'discount','tax_rate','rate', 'amount', 'description',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoiceItem ) {
            $invoiceItem->uuid = Str::uuid();
        });
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
