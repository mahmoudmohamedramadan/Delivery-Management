@extends('layouts.app')@section('title', 'Delegate\'s Order Data | Delivery Management')
@section('ajax')
    <script>
        $(document).ready(function() {
            $(document).ajaxStart(function() {
                $('#wait-msg').show();
            });
            $(document).ajaxComplete(function() {
                $('#wait-msg').hide();
            });
            $(document).on('click', '.delete-ajax', function(e) {
                const id = $(this).attr('delete-id');
                e.preventDefault();
                $.ajax({
                    type: 'DELETE',
                    url: '/index/ajax/delegate-order/' + id,
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status) {
                            $('.row-' + id).remove();
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            $('#search').keyup(function() {
                $.ajax({
                    type: 'get',
                    url: '/index/search/delegate-order',
                    data: {
                        searchVal: $(this).val()
                    },
                    success: function(data) {
                        console.log(data.searchSection);
                        $('#table-body').empty().html(data.searchSection);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });

    </script>
@stop
@section('content')
    @if ($orders->count() > 0)
        <div id="wait-msg" style="display: none;position:absolute;z-index:
        100000;margin-top: 330px;margin-left: 530px" class="spinner-border
        text-primary" role="status"></div>
        <form style="width:740px;padding:5 5 15 5;background:#efefef;
          margin-bottom:60px;margin-top:10px;float:left">
            <label>
                <input type="text" id="search" class="input" placeholder="Search...">
                <div class="line-box">
                    <div class="line"></div>
                </div>
                <span class="font-semibold text-gray-500 float-left m-2">search with
                    shop name or customer address</span>
            </label>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Delegate Name</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Customer Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($orders as $order)
                    <tr class="row-{{ $order->id }}">
                        <td>{{ $order->id }}</td>
                        <td><a href="/index/delegate-order/{{ $order->id }}">{{ $order->delegate['name'] }}</a>
                        </td>
                        <td>{{ $order->shop_name }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            <form action="{{ action('Order\OrderController@destroy', ['id' => $order->id]) }}" method="POST"
                                style="width:auto;margin:0px;padding:0px;background:none">
                                @csrf
                                @method('DELETE')
                                <input type="button" value="Edit Data" class="btn btn-success"
                                onclick="location.href = '/index/delegate-order/{{ $order->id }}/edit' ">
                                <input type="submit" value="Delete" class="btn btn-danger">
                                <input delete-id="{{ $order->id }}" type="button" value="Delete Ajax"
                                    class="delete-ajax btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <label class="pagination justify-content-center">
            {{ $orders->links() }}
        </label>
    @else
        <div class="alert alert-warning">
            <strong>Warning</strong><br>
            <span>there is no any delegate's order until now,</span><a href="/index/delegate-order/create"
                class="underline ml-2">create new
                one</a>
        </div>
    @endif
@endsection
