@extends('layouts.app2')

@section('content')
<div class="container">
    <h3>Invoice</h3>
    <table class="table">
        <thead>
            <tr>
                <th>WebsiteID</th>
                <th>website_name</th>
                <th>website_url</th>
                <th>website_bill</th>
            </tr>
        </thead>
        <tbody>
           
            @foreach ($billedWebsites as $billedWebsite)
                <tr>
                    <td>{{ $billedWebsite->id }}</td>
                    <td>{{ $billedWebsite->name }}</td>
                    <td>{{ $billedWebsite->url }}</td>
                    <td>{{ $billedWebsite->bill }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
