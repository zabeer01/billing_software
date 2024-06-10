<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Website;
use App\Models\Customer;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $website_name = 'Velma Lancaster';
        $customers = Customer::whereHas('websites', function ($query) use ($website_name) {
            $query->where('name', $website_name);
        })->get();
        $customerIds = $customers->pluck('id')->toArray();
           // Retrieve the websites owned by all three customers
        $websites = Website::whereHas('customers', function ($query) use ($customerIds) {
            $query->whereIn('customer_id', $customerIds);
        })->whereDoesntHave('customers', function ($query) use ($customerIds) {
            $query->whereNotIn('customer_id', $customerIds);
        })
        ->get();
        return view('bills.index',compact('customers','customerIds','websites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }


    public function payAjax(Request $request)
    {
        $ajaxData = $request->all(); 
        session()->put('ajaxData', $ajaxData);
        return response()->json(['redirect_url' => route('bills.invoice')]);
    }
    
    public function invoiceGenerate()
    {
        $ajaxData = session()->get('ajaxData'); 
        session()->flush();  
        $billingWebsiteID = $ajaxData['billingWebsiteID'];  
        $billedWebsites  = Website::whereIn('id',$billingWebsiteID)->get();
        return view('bills.invoice', compact('billedWebsites'));
    }
    
}
