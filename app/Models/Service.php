<?php

namespace App\Models;

use App\Models\InvoiceItem;
use App\Models\QuotationItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'uuid', 'HSN_code'
    ];

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
