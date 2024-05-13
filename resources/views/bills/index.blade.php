@extends('layouts.app2')

@section('content')
    <div class="container">
        <table class="table table-bordered" id="websiteTable">

            <thead>
                <tr>
                    <th>
                        <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                    </th>
                    <th>no</th>
                    <th>Website Name</th>
                    <th>Website URL</th>
                    <th>Bill</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($websites as $website)
                    <tr>
                        <td>
                            <input class="form-check-input websiteCheckbox" type="checkbox" value="{{ $website->id }}">
                        </td>
                        <td>{{ $website->id }}</td>
                        <td>{{ $website->name }}</td>
                        <td>{{ $website->url }}</td>
                        <td class="bill">{{ $website->bill }}</td>
                    </tr>
                    
                @endforeach
                <tr>
                    <td></td><td></td><td></td>
                   
                    <td>total </td>
                    <td id='total'></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('hi');
        });
    </script>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Calculate total bill on DOM ready
            var total = 0;
            $('#websiteTable tbody .bill').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total);
        });
    </script>
@endsection

