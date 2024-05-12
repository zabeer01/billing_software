<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Customer;
use App\DataTables\WebsitesDataTable;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;


class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WebsitesDataTable $dataTable)
    {
        return $dataTable->render('websites.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('websites.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $website = new Website();
        $website->name = $request->name;
        $website->url = $request->url;
        $website->bill = $request->bill;
        $website->end_date = $request->end_date;
        /*  Website::create($request->all()); we cant use if we use it website->id wont be inserted in teh pivot table */
        $website->save();
        if ($request->customer_id) {
         
            $website->customers()->sync($request->customer_id);
        }        
        return redirect()->route('websites.index')->with('success', 'Customer created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $website = Website::find($id);
        $customers = Customer::all();
        $current_customer_id = $website->customers();
        return view('websites.edit',compact('website','customers','current_customer_id'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $website = Website::findOrFail($id);
    
        $website->name = $request->name;
        $website->url = $request->url;
        $website->bill = $request->bill;
        $website->end_date = $request->end_date;
        $website->save();
    
        if ($request->customer_id) {
            $website->customers()->sync($request->customer_id);
        } else {
            // If no customers are selected, detach all existing relationships
            $website->customers()->detach();
        }
    
        return redirect()->route('websites.index')->with('success', 'Website updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $website = Website::find($id);
        if (!$website) {
            return redirect()->back()->with('error', 'Customer not found.');
        }
        $website->delete();

        return redirect()->route('websites.index')->with('success', 'Customer deleted successfully');
    }
}
