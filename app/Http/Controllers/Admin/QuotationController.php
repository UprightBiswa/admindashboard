<?php

namespace App\Http\Controllers\Admin;

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
        return view('Admin.quotations.create',compact('customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $quotation = new Quotation();
        $quotation->customer_id=$request->input('customer_id');
        $quotation->uuid = Str::uuid();
        $quotation->save();

        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity');
        $descriptions= $request->input('descriptions');
        $taxs= $request->input('tax');
        $rates = $request->input('rate');

        foreach ($serviceIds as $key => $serviceId){
                $service = Service::findOrFail($serviceId);

                $qAmount = $quantities[$key] * $rates[$key];
                $totaltax =  $qAmount * ($taxs[$key]/100);
                $totalAmount= $qAmount+$totaltax;

            $quotationItem = new QuotationItem();
            $quotationItem->uuid = Str::uuid();
            $quotationItem->quotation_id = $quotation->id;
            $quotationItem->service_id = $serviceId;
            $quotationItem->quantity = $quantities[$key];
            $quotationItem->rate = $rates[$key];
            $quotationItem->description =$descriptions[$key] ;
            $quotationItem->tax_rate =$taxs[$key] ;
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

    // public function update(Request $request, $id){

    //     $quotation = Quotation::findOrFail($id);
    //     $quotation->customer_id=$request->input('customer_id');
    //     $quotation->save();

    //     $serviceIds = $request->input('service_id');
    //     $quantities = $request->input('quantity');
    //     $description= $request->input('description');
    //     $taxs= $request->input('tax_rate');
    //     $rates = $request->input('rate');

    //     $quotationItems = $quotation->quotationitems;
    //     foreach ($quotationItems as $key => $quotationItem) {
    //         $quotationItem->service_id = $serviceIds[$key];
    //         $quotationItem->quantity = $quantities[$key];
    //         $quotationItem->description =$description[$key] ;
    //         $quotationItem->tax_rate =$taxs[$key] ;
    //         $quotationItem->rate = $rates[$key];
    //         $qAmount = $quantities[$key] * $rates[$key];
    //         $totaltax =  $qAmount * ($taxs[$key]/100);
    //         $totalAmount= $qAmount+$totaltax;
    //         $quotationItem->amount = $totalAmount;
    //         $quotationItem->save();
    //     }

    //     $newServiceIds = $request->input('service_id');
    //     $newQuantities = $request->input('quantity');
    //     $newDescriptions= $request->input('descriptions');
    //     $newTaxs= $request->input('tax_rate');
    //     $newRates = $request->input('rate');

    //     for ($i = count($quotationItems); $i < count($newServiceIds); $i++) {
    //         $service = Service::findOrFail($newServiceIds[$i]);
    //         $qAmount = $newQuantities[$i] * $newRates[$i];
    //         $totaltax =  $qAmount * ($newTaxs[$i]/100);
    //         $totalAmount= $qAmount+$totaltax;

    //         $quotationItem = new QuotationItem();
    //         $quotationItem->uuid = Str::uuid();
    //         $quotationItem->quotation_id = $quotation->id;
    //         $quotationItem->service_id = $newServiceIds[$i];
    //         $quotationItem->quantity = $newQuantities[$i];
    //         $quotationItem->rate = $newRates[$i];
    //         $quotationItem->description =$newDescriptions[$i] ;
    //         $quotationItem->tax_rate =$newTaxs[$i] ;
    //         $quotationItem->amount = $totalAmount;
    //         $quotationItem->save();
    //     }

    //       return redirect('admin/quotations')->with('success', 'Quotation updated successfully.');
    //     }

    public function update(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->customer_id = $request->input('customer_id');
        $quotation->save();

        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity');
        $description = $request->input('description');
        $taxs = $request->input('tax_rate');
        $rates = $request->input('rate');

        $quotationItems = $quotation->quotationitems;

        foreach ($quotationItems as $key => $quotationItem) {
            $quotationItem->service_id = $serviceIds[$key];
            $quotationItem->quantity = $quantities[$key];
            $quotationItem->description = $description[$key];
            $quotationItem->tax_rate = $taxs[$key];
            $quotationItem->rate = $rates[$key];
            $qAmount = $quantities[$key] * $rates[$key];
            $totaltax = $qAmount * ($taxs[$key] / 100);
            $totalAmount = $qAmount + $totaltax;
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
}
