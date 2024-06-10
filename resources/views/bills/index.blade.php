@extends('layouts.app2')

@section('content')
    <div class="container">
        <table class="table table-bordered" id="websiteTable">

            <thead>
                <tr>
                    <th>
                        all
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
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>total </td>
                    <td id='total'></td>
                </tr>
            </tbody>
        </table>
        <button id="submitBtn">submit</button>
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
            var billingWebsiteID = [];

            $('#websiteTable tbody .bill').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total);

            //define the array to send

            $("#websiteTable").on("click", function(e) {
                if (e.target.value) {
                    var x = +e.target.value;
                    if (e.target.checked) {
                        billingWebsiteID.push(x);
                        //filter doplicates 
                        billingWebsiteID = [...new Set(billingWebsiteID)];
                    } else {
                        //For id = 3: 3 !== 3 is false, so 3 is excluded from the new array.
                        billingWebsiteID = billingWebsiteID.filter(id => id !== x);
                    }
                    console.log(billingWebsiteID);
                }
            });
            $('#submitBtn').click(function(e) {

                /* 
                console.log(billingWebsiteID);
                console.log(typeof(billingWebsiteID[0]));
                return ;  */
                e.preventDefault();
                if (billingWebsiteID.length > 0) {

                //send ajax request
                $.ajax({
                    type: "POST",
                    url: '{{ route('bills.payAjax') }}',
                    data: {
                        billingWebsiteID: billingWebsiteID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Request sent successfully!');
                        console.log(response); // Log the response from the server

                        // Redirect to the URL received from the server
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }


            });
        });
    </script>
@endsection
