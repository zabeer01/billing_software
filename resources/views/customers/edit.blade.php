@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($customer) ? 'Edit Customer' : 'Create Customer' }}</h2>
    <form method="POST" action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }}">
        @csrf
        @if(isset($customer))
            @method('PUT')
        @endif

        <div class="form-group  mt-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($customer) ? $customer->name : '' }}">
        </div>

        <div class="form-group mt-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ isset($customer) ? $customer->email : '' }}">
        </div>

        <div class="form-group  mt-3">
            <label for="phone_no">Phone Number</label>
            <input type="tel" class="form-control" id="phone_no" name="phone_no" value="{{ isset($customer) ? $customer->phone_no : '' }}">
        </div>
        <div class="form-group  mt-3">
            <label for="bill">Bill</label>
            <input type="tel" class="form-control" id="bill" name="bill" value="{{ isset($customer) ? $customer->bill : '' }}">
        </div>
      

        <div class="mt-2">
            <button type="submit" class="btn btn-primary btn-sm">{{ isset($customer) ? 'Update' : 'Submit' }}</button>
        </div>
    </form>
</div>
@endsection
