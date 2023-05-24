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
    public function search(Request $request)
{
    $search = $request->input('search');
    $customers = Customer::where('name', 'like', '%' . $search . '%')->get();

    // Store the last search value in session flash data
    $request->session()->flash('lastSearch', $search);

    // Retrieve the search history from session
    $searchHistory = $request->session()->get('searchHistory', []);

    // Add the current search value to the search history
    array_unshift($searchHistory, $search);

    // Limit the search history to the last two or three values
    $searchHistory = array_slice($searchHistory, 0, 3);

    // Store the updated search history in session
    $request->session()->put('searchHistory', $searchHistory);

    return view('admin.search', compact('customers'));
}

}
