@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Customer</h2>
    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        <div class="form-group  mt-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
    
    
        <div class="form-group mt-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" >
          
        </div>
    
        <div class="form-group  mt-3">
            <label for="phone_no">Phone Number</label>
            <input type="text" class="form-control" id="phone_no" name="phone_no" >
        </div>
        <div class="form-group  mt-3">
            <label for="bill">Bill</label>
            <input type="number" class="form-control" id="bill" name="bill" >
        </div>
    
      
     <div class="mt-2">
    
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </div>
    </form>
    
    
</div>
@endsection
