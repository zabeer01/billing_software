@extends('layouts.app2')

@section('content')
<div class="container">
    <h2>Create Website</h2>
    <form method="POST" action="{{ route('websites.store') }}"  >
        {{-- --}}
    @csrf
        <div class="form-group">
            <label for="customer">customer:</label>
            <select class="form-control" id="e9" name="customer_id[]" multiple="multiple">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
       

        <div class="form-group  mt-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
        <div class="form-group  mt-3">
            <label for="url">url</label>
            <input type="text" class="form-control" id="url" name="url" >
        </div>
    
       
        <div class="form-group  mt-3">
            <label for="bill">Bill</label>
            <input type="number" class="form-control" id="bill" name="bill" >
        </div>
        <div class="form-group  mt-3">
            <label for="end_date">End Date</label>
            <input type="text" class="form-control" id="end_date" name="end_date" >
        </div>
    
      
     <div class="mt-2">
    
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </div>
    </form>
    
    
</div>
@endsection

@section('scripts')
    <script>
        //select 2
        $(document).ready(function() {
            $("#e9").select2({
                placeholder:"search customer",
                allowClear:true,

            });
        });

    </script>
@endsection