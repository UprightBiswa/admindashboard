<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuotationItem;
use App\Http\Controllers\Controller;
use pdf;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::all();
        $quotationItems = QuotationItem::all();

        return view('Admin.quotations.index', compact('quotations', 'quotationItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('Admin.quotations.create', compact('customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'customer_id' => 'required',
        'service_id.*' => 'required',
        'quantity.*' => 'required|numeric|min:0',
        'descriptions.*' => 'required',
        'rate.*' => 'required|numeric|min:0',
        'tax.*' => 'required|numeric|min:0|max:100',
        'issue_date' => 'required|date_format:Y-m-d',
        'expiry_date' => 'required|date_format:Y-m-d|after:issue_date',
    ]);

    $quotation = new Quotation();
    $quotation->customer_id = $validatedData['customer_id'];
    $quotation->uuid = Str::uuid();
    $quotation->issue_date = $validatedData['issue_date'];
    $quotation->expiry_date = $validatedData['expiry_date'];
    $quotation->save();

    foreach ($validatedData['service_id'] as $key => $serviceId) {
        $service = Service::findOrFail($serviceId);

        $qAmount = $validatedData['quantity'][$key] * $validatedData['rate'][$key];
        $totaltax = $qAmount * ($validatedData['tax'][$key] / 100);
        $totalAmount = $qAmount + $totaltax;

        $quotationItem = new QuotationItem();
        $quotationItem->uuid = Str::uuid();
        $quotationItem->quotation_id = $quotation->id;
        $quotationItem->service_id = $serviceId;
        $quotationItem->quantity = $validatedData['quantity'][$key];
        $quotationItem->rate = $validatedData['rate'][$key];
        $quotationItem->description = $validatedData['descriptions'][$key];
        $quotationItem->tax_rate = $validatedData['tax'][$key];
        $quotationItem->amount = $totalAmount;
        $quotationItem->save();
    }
    return redirect('admin/quotations')->with('success', 'Quotation created successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        return view('Admin.quotations.show', compact('quotation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $customers = Customer::all();
        $services = Service::all();

        return view('Admin.quotations.edit', compact('quotation', 'customers', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, $id)
     {
         $validatedData = $request->validate([
             'customer_id' => 'required',
             'service_id.*' => 'required',
             'quantity.*' => 'required|numeric|min:0',
             'descriptions.*' => 'required',
             'rate.*' => 'required|numeric|min:0',
             'tax_rate.*' => 'required|numeric|min:0|max:100',
             'issue_date' => 'required|date_format:Y-m-d',
             'expiry_date' => 'required|date_format:Y-m-d|after:issue_date',
         ]);

         $quotation = Quotation::findOrFail($id);
         $quotation->customer_id = $validatedData['customer_id'];
         $quotation->issue_date = $validatedData['issue_date'];
         $quotation->expiry_date = $validatedData['expiry_date'];
         $quotation->save();

         // Delete existing quotation items
         $quotation->quotationItems()->delete();

         foreach ($validatedData['service_id'] as $key => $serviceId) {
             $service = Service::findOrFail($serviceId);

             $qAmount = $validatedData['quantity'][$key] * $validatedData['rate'][$key];
             $totaltax = $qAmount * ($validatedData['tax_rate'][$key] / 100);
             $totalAmount = $qAmount + $totaltax;

             $quotationItem = new QuotationItem();
             $quotationItem->uuid = Str::uuid();
             $quotationItem->quotation_id = $quotation->id;
             $quotationItem->service_id = $serviceId;
             $quotationItem->quantity = $validatedData['quantity'][$key];
             $quotationItem->rate = $validatedData['rate'][$key];
             $quotationItem->description = $validatedData['descriptions'][$key];
             $quotationItem->tax_rate = $validatedData['tax_rate'][$key];
             $quotationItem->amount = $totalAmount;
             $quotationItem->save();
         }
         return redirect('admin/quotations')->with('success', 'Quotation updated successfully.');
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->quotationItems()->delete();
        $quotation->delete();

        return redirect('admin/quotations')
            ->with('success', 'Quotation deleted successfully.');
    }

    public function pdf(Quotation $quotation)
    {

        $customers = Customer::all();
        $services = Service::all();

        return view('Admin.quotations.pdf', compact('quotation', 'customers', 'services'));
    }
}
