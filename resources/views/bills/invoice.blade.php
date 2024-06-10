@extends('layouts.app2')

@section('content')
<div>
    <h3>Invoice</h3>
    <table>
        <thead>
            <tr>
                <th>billingWebsiteID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $billingWebsiteID = $ajaxData['billingWebsiteID'];  
            ?>
            @foreach ($billingWebsiteID as $result)
                <tr>
                    <td>{{ $result }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
