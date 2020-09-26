@section('orderSection')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#filter-data').DataTable();
        });

    </script>
    <div class="bg-white">
        <table class="table" id="filter-data">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Delegate Name</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Customer Address</th>
                    <th scope="col">Phone Number</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($orders as $order)
                    <tr class="row-{{ $order->id }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->delegate['name'] }}</td>
                        <td>{{ $order->shop_name }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
