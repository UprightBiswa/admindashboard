<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id', 'service_id', 'quantity', 'rate', 'description', 'tax_rate', 'amount'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotationItem) {
            $quotationItem->uuid = Str::uuid();
        });
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
