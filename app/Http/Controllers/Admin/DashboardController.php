<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\Quotation;

class DashboardController extends Controller
{
    public function index()
    {
        $customersCount = Customer::count();
        $servicesCount = Service::count();
        $invoicesCount = Invoice::count();
        $quotationsCount = Quotation::count();

        $totalAmount = Invoice::sum('total_amount');
        $paidAmount = Invoice::where('payment_status', 1)->sum('total_amount');
        $dueAmount = $totalAmount - $paidAmount;

        $invoices = Invoice::with('customer')->where('payment_status', 0)->get();

        return view('admin.dashboard', compact('customersCount', 'servicesCount', 'invoicesCount', 'quotationsCount', 'totalAmount', 'paidAmount', 'dueAmount', 'invoices'));
    }
}
