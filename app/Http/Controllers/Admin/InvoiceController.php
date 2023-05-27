<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Customer;
use App\Mail\InvoiceEmail;
use App\Models\InvoiceItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Invoice  $invoice)
    {

        // // Add tax rate of current item to total tax rate
        // $invoiceItems = $invoice->invoice_items;
        // $totalTaxRate = 0;

        // if ($invoiceItems) {
        //     foreach ($invoiceItems as $invoiceItem) {
        //         $service = $invoiceItem->service;
        //         $totalTaxRate += $service->tax_rate;
        //     }
        // }

        $invoices  = Invoice::paginate(5);
        $invoiceItem = InvoiceItem::paginate(5);

        return view('Admin.invoices.index', compact('invoices', 'invoiceItem', ));
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
            'rate.*' => 'required|numeric|min:0',
            'tax_rate.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
            'amount.*' => 'required|numeric|min:0',
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
            $quantity = $validatedData['quantity'][$key];
            $rate = $validatedData['rate'][$key];
            $tax_rate = $validatedData['tax_rate'][$key];
            $discount = $validatedData['discount'][$key];
            $amount = $validatedData['amount'][$key];

            $totalAmount += $amount;

            $invoiceItem = new InvoiceItem();
            $invoiceItem->uuid = Str::uuid();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->service_id = $serviceId;
            $invoiceItem->quantity = $quantity;
            $invoiceItem->rate = $rate;
            $invoiceItem->description = $validatedData['descriptions'][$key];
            $invoiceItem->tax_rate = $tax_rate;
            $invoiceItem->discount = $discount;
            $invoiceItem->amount = $amount;
            $invoiceItem->save();
        }

        $invoice->total_amount = $totalAmount;
        $invoice->save();



        return redirect('admin/invoices')->with('message', 'Invoice created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $prefix = 'TCPIPL/IN/';
        $count = Invoice::where('id', '<=', $invoice->id)->count();
        $formattedCount = str_pad($count, 5, '0', STR_PAD_LEFT);
        $invoiceId = $prefix . $formattedCount;
        $subtotal = $invoice->total_amount;

        return view('Admin.invoices.show', compact('invoice', 'invoiceId', 'subtotal'));
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
            'rate.*' => 'required|numeric|min:0',
            'tax_rate.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
            'amount.*' => 'required|numeric|min:0',
            'descriptions.*' => 'required',
            'issue_date' => 'required|date_format:Y-m-d',
            'expiry_date' => 'required|date_format:Y-m-d|after:issue_date',
        ]);

        $invoice = Invoice::findOrFail($id);
        if ($invoice->payment_status == 1) {
            return redirect('admin/invoices')->with('message', 'Cannot update a paid invoice.');
        }

        $invoice->customer_id = $validatedData['customer_id'];
        $invoice->payment_status =  $validatedData['payment_status'];
        $invoice->issue_date = $validatedData['issue_date'];
        $invoice->expiry_date = $validatedData['expiry_date'];
        $invoice->save();

        // delete all existing invoice items and recreate them with the updated data
        $invoice->invoiceItems()->delete();
        $totalAmount = 0;

        foreach ($validatedData['service_id'] as $key => $serviceId) {
            $quantity = $validatedData['quantity'][$key];
            $rate = $validatedData['rate'][$key];
            $tax_rate = $validatedData['tax_rate'][$key];
            $discount = $validatedData['discount'][$key];
            $amount = $validatedData['amount'][$key];

            $totalAmount += $amount;

            $invoiceItem = new InvoiceItem();
            $invoiceItem->uuid = Str::uuid();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->service_id = $serviceId;
            $invoiceItem->quantity = $quantity;
            $invoiceItem->rate = $rate;
            $invoiceItem->description = $validatedData['descriptions'][$key];
            $invoiceItem->tax_rate = $tax_rate;
            $invoiceItem->discount = $discount;
            $invoiceItem->amount = $amount;
            $invoiceItem->save();
        }

        $invoice->total_amount = $totalAmount;
        $invoice->save();

        return redirect('admin/invoices')->with('message', 'Invoice updated successfully.');
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

        return redirect('admin/invoices')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function pdf(Invoice $invoice)
    {
        $prefix = 'TCPIPL/IN/';
        $count = Invoice::where('id', '<=', $invoice->id)->count();
        $formattedCount = str_pad($count, 5, '0', STR_PAD_LEFT);
        $invoiceId = $prefix . $formattedCount;
        $subtotal = $invoice->total_amount;

        $customers = Customer::all();
        $services = Service::all();
        $payments = Payment::all();

        return view('Admin.invoices.pdf', compact('invoice', 'customers', 'services', 'payments', 'invoiceId','subtotal'));
    }

    public function paymentDetails(Invoice $invoice)
    {
        $customer = $invoice->customer;
        return view('admin.payment.details', compact('invoice','customer'));
    }

    public function submitPayment(Request $request, Invoice $invoice)
    {
        $customer = $invoice->customer;

        $payment = new Payment;
        $payment->customer_id = $customer->id;
        $payment->payment_date = $request->payment_date;
        $payment->sub_total = $request->sub_total;
        $payment->transaction_id = $request->transaction_id;
        $payment->total_amount = $request->total_amount;
        $payment->gst = $request->gst;
        $payment->payment_method = $request->payment_method;
        $customer->payments()->save($payment);

        $invoice->payment_status = '1';
        $invoice->save();

        return redirect('admin/invoices')
            ->with('message', 'Payment submitted successfully.');
    }
    public function mailInvoice(Invoice $invoice)
    {
        $prefix = 'TCPIPL/IN/';
        $count = Invoice::where('id', '<=', $invoice->id)->count();
        $formattedCount = str_pad($count, 5, '0', STR_PAD_LEFT);
        $invoiceId = $prefix . $formattedCount;
        $subtotal = $invoice->total_amount;

        $customerEmail = $invoice->customer->email;

        $mail = new InvoiceEmail($invoice, $invoiceId, $subtotal);

        Mail::to($customerEmail)->send($mail);

        if(Mail::failures()){
            return redirect('admin/invoices')->with('message', 'Failed to send invocie email');
        }

        return redirect('admin/invoices')->with('message', 'Invocie email sent to : ' . $invoice->customer->email);
    }
}
