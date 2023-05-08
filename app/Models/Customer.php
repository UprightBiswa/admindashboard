<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'description', 'address', 'gst_no'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->uuid = Str::uuid();
        });
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
