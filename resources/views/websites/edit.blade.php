@extends('layouts.app2')

@section('content')
<div class="container">
    <h2>Edit Website</h2>
    <form method="POST" action="{{ route('websites.update', ['website' => $website->id]) }}">
    @csrf
    @method('PUT') <!-- This line is crucial for Laravel to recognize it as an update request -->

        <div class="form-group">
            <label for="customer">Customer:</label>
            <select class="form-control" id="e9" name="customer_id[]" multiple="multiple">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
       

        <div class="form-group mt-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $website->name }}">
        </div>
        <div class="form-group mt-3">
            <label for="url">URL</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ $website->url }}">
        </div>
    
       
        <div class="form-group mt-3">
            <label for="bill">Bill</label>
            <input type="number" class="form-control" id="bill" name="bill" value="{{ $website->bill }}">
        </div>
        <div class="form-group mt-3">
            <label for="end_date">End Date</label>
            <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $website->end_date }}">
        </div>
    
      
        <div class="mt-2">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
</div>
<?php 
/* $array = $website->customers->pluck('id')->toArray();
foreach ($array as $item) {
    echo $item."<br>";
} */

?>
@endsection

@section('scripts')
    <script>
        // Select2
        $(document).ready(function() {
            $("#e9").select2({
                placeholder: "Search customer",
                allowClear: true
            });

            // Pre-selecting values
            var selectedValues = {!! json_encode($website->customers->pluck('id')->toArray()) !!};
            $("#e9").val(selectedValues).trigger('change');
        });
    </script>
@endsection
