<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(5);

        return view('Admin.customers.index', compact('customers'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.customers.create');
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
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'gst_no' => 'nullable|string|max:50',
            'description' => 'nullable|string',


        ]);
        $customer = new Customer([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'gst_no' => $validatedData['gst_no'],
            'description' => $validatedData['description'],
        ]);
        $customer->uuid = Str::uuid();
        $customer->save();

        // Add notification message to the user's session or data
        $message = 'New customer added '. $validatedData['name'];
        $notifications = session()->get('notifications', []);
        $notifications[] = $message;
        session()->put('notifications', $notifications);

        return redirect('admin/customers')->with('message', 'Customer created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('Admin.customers.show', compact('customer'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('Admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'gst_no' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $customer->name = $validatedData['name'];
        $customer->email = $validatedData['email'];
        $customer->phone = $validatedData['phone'];
        $customer->address = $validatedData['address'];
        $customer->gst_no = $validatedData['gst_no'];
        $customer->description = $validatedData['description'];
        $customer->save();
        return redirect('admin/customers')->with('message', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // Check if the customer has associated invoices or quotations
        if ($customer->invoices()->count() > 0 || $customer->quotations()->count() > 0) {
            return redirect('admin/customers')->with('message', 'Cannot delete this customer. There are associated invoices or quotations.');
        }
        $customer->delete();
        return redirect('admin/customers')->with('message', 'customer deleted successfully.');
    }
}
