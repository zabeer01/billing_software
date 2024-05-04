<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Customer;
use App\DataTables\WebsitesDataTable;
use Illuminate\Http\Request;

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
         
            $website->customers()->sync($request->customer_id,$website->id);
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
    public function edit(Website $website)
    {
        $customers = Customer::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Website $website)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Website $website)
    {
        //
    }
}
