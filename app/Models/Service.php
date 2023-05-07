<?php

namespace App\Models;

use App\Models\InvoiceItem;
use Illuminate\Support\Str;
use App\Models\QuotationItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'tax_rate','description', 'HSN_code'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->uuid = Str::uuid();
        });
    }
    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
