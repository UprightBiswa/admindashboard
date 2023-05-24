<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(1);
        return view('Admin.service.index', compact('services'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.service.create');
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'HSN_code' => 'required|string|max:10',
        ]);
        $service = new Service([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'tax_rate' => $validatedData['tax_rate'],
            'description' => $validatedData['description'],
            'HSN_code' => $validatedData['HSN_code'],
        ]);
        $service->uuid = Str::uuid();
        $service->save();
        return redirect('admin/services')->with('message', 'Service created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('Admin.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('Admin.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'HSN_code' => 'required|string|max:10',
        ]);
        $service->name = $validatedData['name'];
        $service->price = $validatedData['price'];
        $service->tax_rate = $validatedData['tax_rate'];
        $service->HSN_code = $validatedData['HSN_code'];
        $service->description = $validatedData['description'];
        $service->save();

        $service->uuid = Str::uuid();
        $service->save();

        return redirect('admin/services')->with('message', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if ($service->invoiceItems()->count() > 0 || $service->quotationItems()->count() > 0) {
            return redirect('admin/services')->with('message', 'Cannot delete this service. There are associated invoices or quotations.');
        }
        $service->delete();
        return redirect('admin/services')->with('message', 'service delered successfully.');
    }
}

