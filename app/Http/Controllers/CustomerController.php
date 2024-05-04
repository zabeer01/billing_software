<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\DataTables\CustomersDataTable;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render('customers.index');
    }

    public function create()
    {
       return view('customers.create');
    }

    public function store(Request $request)
    {
        /* return dd($request); */
        // Create a new customer instance and directly assign request data
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_no = $request->phone_no;
        $customer->bill = $request->bill;

        $customer->save();
    
        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit',compact('customer'));

    }


    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_no = $request->phone_no;
        $customer->bill = $request->bill;
        $customer->save();
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
    
}
