<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Customer;
use App\Models\InvoiceItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Invoice  $invoice)
    {

        // Add tax rate of current item to total tax rate
        $invoiceItems = $invoice->invoice_items;
        $totalTaxRate = 0;

        if ($invoiceItems) {
            foreach ($invoiceItems as $invoiceItem) {
                $service = $invoiceItem->service;
                $totalTaxRate += $service->tax_rate;
            }
        }

        $invoices  = Invoice::all();
        $invoiceItem = InvoiceItem::all();

        return view('Admin.invoices.index', compact('invoices', 'invoiceItem', 'totalTaxRate'));
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
        $paymentOptions = [
            0 => 'Not paid',
            1 => 'Paid',
        ];
        return view('Admin.invoices.create', compact('customers', 'services', 'paymentOptions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'service_id.*' => 'required',
            'payment_status' => 'required|in:0,1',
            'quantity.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
            'descriptions.*' => 'required',
            'issue_date' => 'required|date_format:Y-m-d',
            'expiry_date' => 'required|date_format:Y-m-d|after:issue_date',
        ]);

        $invoice = new Invoice();
        $invoice->customer_id = $validatedData['customer_id'];
        $invoice->uuid = Str::uuid();
        $invoice->payment_status =  $validatedData['payment_status'];
        $invoice->issue_date = $validatedData['issue_date'];
        $invoice->expiry_date = $validatedData['expiry_date'];
        $invoice->save();

        $totalAmount = 0;

        foreach ($validatedData['service_id'] as $key => $serviceId) {
            $service = Service::findOrFail($serviceId);

            $qAmount = $validatedData['quantity'][$key] * $service->price;
            $totaltax = $qAmount * ($service->tax_rate / 100);
            $totalAmountItem  = $qAmount + $totaltax;
            $discounttax = $totalAmountItem * ($validatedData['discount'][$key] / 100);
            $discountamount = $totalAmountItem - $discounttax;
            $totalAmount += $discountamount;

            $invoiceItem = new InvoiceItem();
            $invoiceItem->uuid = Str::uuid();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->service_id = $serviceId;
            $invoiceItem->quantity = $validatedData['quantity'][$key];
            $invoiceItem->rate = $service->price;
            $invoiceItem->description = $validatedData['descriptions'][$key];
            $invoiceItem->tax_rate = $service->tax_rate;
            $invoiceItem->amount = $discountamount;
            $invoiceItem->discount = $validatedData['discount'][$key];
            $invoiceItem->save();
        }

        $invoice->total_amount = $totalAmount;
        $invoice->save();



        return redirect('admin/invoices')->with('success', 'Invoice created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('Admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $services = Service::all();
        $paymentOptions = [
            0 => 'Not paid',
            1 => 'Paid',
        ];

        return view('Admin.invoices.edit', compact('invoice', 'customers', 'services', 'paymentOptions'));
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
            'payment_status' => 'required|in:0,1',
            'quantity.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
            'descriptions.*' => 'required',
            'issue_date' => 'required|date_format:Y-m-d',
            'expiry_date' => 'required|date_format:Y-m-d|after:issue_date',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->customer_id = $validatedData['customer_id'];
        $invoice->payment_status =  $validatedData['payment_status'];
        $invoice->issue_date = $validatedData['issue_date'];
        $invoice->expiry_date = $validatedData['expiry_date'];
        $invoice->save();

        // delete all existing invoice items and recreate them with the updated data
        $invoice->invoiceItems()->delete();
        $totalAmount = 0;

        foreach ($validatedData['service_id'] as $key => $serviceId) {
            $service = Service::findOrFail($serviceId);

            $qAmount = $validatedData['quantity'][$key] * $service->price;
            $totaltax = $qAmount * ($service->tax_rate / 100);
            $totalAmountItem  = $qAmount + $totaltax;
            $discounttax = $totalAmountItem * ($validatedData['discount'][$key] / 100);
            $discountamount = $totalAmountItem - $discounttax;
            $totalAmount += $discountamount;

            $invoiceItem = new InvoiceItem();
            $invoiceItem->uuid = Str::uuid();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->service_id = $serviceId;
            $invoiceItem->quantity = $validatedData['quantity'][$key];
            $invoiceItem->rate = $service->price;
            $invoiceItem->description = $validatedData['descriptions'][$key];
            $invoiceItem->tax_rate = $service->tax_rate;
            $invoiceItem->amount = $discountamount;
            $invoiceItem->discount = $validatedData['discount'][$key];
            $invoiceItem->save();
        }

        $invoice->total_amount = $totalAmount;
        $invoice->save();

        return redirect('admin/invoices')->with('success', 'Invoice updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {

        $invoice->invoiceItems()->delete();
        $invoice->delete();

        return redirect('admin/invoice')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function pdf(Invoice $invoice)
    {

        $customers = Customer::all();
        $services = Service::all();
        $payments = Payment::all();

        return view('Admin.invoices.pdf', compact('invoice', 'customers', 'services', 'payments'));
    }
    //     public function submitPayment(Request $request, $invoiceId)
    //     {
    //         // validate the form data
    //         $validatedData = $request->validate([
    //             'payment_method' => 'required|string|in:online_upi,offline_cash',
    //             'payment_date' => 'required|date',
    //             'sub_total' => 'required|numeric|min:0',
    //             'transaction_id' => 'required|string|max:255',
    //             'total_amount' => 'required|numeric|min:0',
    //             'gst' => 'required|numeric|min:0',
    //         ]);

    //         // get the invoice
    //         $invoice = Invoice::findOrFail($invoiceId);

    //         // check if the invoice is already paid
    //         if ($invoice->status === 'paid') {
    //             return redirect()->back()->with('error', 'Invoice is already paid.');
    //         }

    //         // update the payment details
    //         $invoice->payment_method = $validatedData['payment_method'];
    //         $invoice->payment_date = $validatedData['payment_date'];
    //         $invoice->sub_total = $validatedData['sub_total'];
    //         $invoice->transaction_id = $validatedData['transaction_id'];
    //         $invoice->total_amount = $validatedData['total_amount'];
    //         $invoice->gst = $validatedData['gst'];
    //         $invoice->status = 'paid';

    //         // save the changes
    //         $invoice->save();

    //         return redirect()->back()->with('success', 'Payment submitted successfully.');
    //     }
    // }
    public function submitPayment(Request $request, Invoice $invoice)
    {
        $customer = $invoice->customer;

        $payment = new Payment;
        $payment->customer_id = $invoice->id;
        $payment->payment_date = $request->payment_date;
        $payment->sub_total = $request->sub_total;
        $payment->transaction_id = $request->_id;
        $payment->total_amount = $request->total_amount;
        $payment->gst = $request->gst;
        $payment->payment_method = $request->payment_method;
        $customer->payments()->save($payment);

        $invoice->payment_status = 'paid';
        $invoice->save();

        return redirect('admin/invoices')
            ->with('success', 'Payment submitted successfully.');
    }
}
