<?php

namespace App\Http\Controllers\Admin;

use App\Mail\QuotationEmail;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use Dompdf\Options;
use pdf;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuotationItem;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::paginate(5);
        $quotationItems = QuotationItem::paginate(5);

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
            'tax_rate.*' => 'required|numeric|min:0',
            'amount.*' => 'required|numeric|min:0',
            'issue_date' => 'required|date_format:Y-m-d',
            'expiry_date' => 'required|date_format:Y-m-d|after:issue_date',
        ]);

        $quotation = new Quotation();
        $quotation->customer_id = $validatedData['customer_id'];
        $quotation->uuid = Str::uuid();
        $quotation->issue_date = $validatedData['issue_date'];
        $quotation->expiry_date = $validatedData['expiry_date'];
        $quotation->save();

        $totalAmount = 0;

        foreach ($validatedData['service_id'] as $key => $serviceId) {
            $quantity = $validatedData['quantity'][$key];
            $rate = $validatedData['rate'][$key];
            $taxRate = $validatedData['tax_rate'][$key];
            $amount = $validatedData['amount'][$key];

            $totalAmount += $amount;

            $quotationItem = new QuotationItem();
            $quotationItem->uuid = Str::uuid();
            $quotationItem->quotation_id = $quotation->id;
            $quotationItem->service_id = $serviceId;
            $quotationItem->quantity = $quantity;
            $quotationItem->rate = $rate;
            $quotationItem->description = $validatedData['descriptions'][$key];
            $quotationItem->tax_rate = $taxRate;
            $quotationItem->amount = $amount;
            $quotationItem->save();
        }

        $quotation->total_amount = $totalAmount;
        $quotation->save();

        return redirect('admin/quotations')->with('message', 'Quotation created successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        $prefix = 'TCPIPL/QN/';
        $count = Quotation::where('id', '<=', $quotation->id)->count();
        $formattedCount = str_pad($count, 5, '0', STR_PAD_LEFT);
        $quotationId = $prefix . $formattedCount;
        $subtotal = $quotation->total_amount;
        return view('Admin.quotations.show', compact('quotation', 'quotationId', 'subtotal'));
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
            'tax_rate.*' => 'required|numeric|min:0',
            'amount.*' => 'required|numeric|min:0',
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

        $totalAmount = 0;

        foreach ($validatedData['service_id'] as $key => $serviceId) {
            $quantity = $validatedData['quantity'][$key];
            $rate = $validatedData['rate'][$key];
            $taxRate = $validatedData['tax_rate'][$key];
            $amount = $validatedData['amount'][$key];


            $totalAmount += $amount;

            $quotationItem = new QuotationItem();
            $quotationItem->uuid = Str::uuid();
            $quotationItem->quotation_id = $quotation->id;
            $quotationItem->service_id = $serviceId;
            $quotationItem->quantity = $quantity;
            $quotationItem->rate = $rate;
            $quotationItem->description = $validatedData['descriptions'][$key];
            $quotationItem->tax_rate = $taxRate;
            $quotationItem->amount = $amount;
            $quotationItem->save();
        }
        $quotation->total_amount = $totalAmount;
        $quotation->save();

        return redirect('admin/quotations')->with('message', 'Quotation updated successfully.');
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
            ->with('message', 'Quotation deleted successfully.');
    }

    public function pdf(Quotation $quotation)
    {
        $prefix = 'TCPIPL/QN/';
        $count = Quotation::where('id', '<=', $quotation->id)->count();
        $formattedCount = str_pad($count, 5, '0', STR_PAD_LEFT);
        $quotationId = $prefix . $formattedCount;
        $subtotal = $quotation->total_amount;

        $customers = Customer::all();
        $services = Service::all();

        return view('Admin.quotations.pdf', compact('quotation', 'customers', 'services', 'quotationId', 'subtotal'));
    }


    public function mailQuotation(Quotation $quotation)
    {
        $prefix = 'TCPIPL/QN/';
        $count = Quotation::where('id', '<=', $quotation->id)->count();
        $formattedCount = str_pad($count, 5, '0', STR_PAD_LEFT);
        $quotationId = $prefix . $formattedCount;
        $subtotal = $quotation->total_amount;

        // Retrieve the necessary data for the quotation email, such as customer details, quotation information, etc.
        $customerEmail = $quotation->customer->email;

        // Create an instance of the QuotationEmail Mailable and pass the necessary data
        $mail = new QuotationEmail($quotation, $quotationId, $subtotal);

        // Send the email
        Mail::to($customerEmail)->send($mail);

        // Optionally, you can check if the email was sent successfully
        if (Mail::failures()) {
            // Email sending failed
            return redirect('admin/quotations')->with('message', 'Failed to send quotation email');
        }

        // Email sent successfully
        return redirect('admin/quotations')->with('message','Quotation email sent to : '. $quotation->customer->email );
    }
}
