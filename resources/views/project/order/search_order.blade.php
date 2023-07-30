@section('searchSection')
@foreach ($orders as $order)
<tr class="row-{{ $order->id }}">
    <td>{{ $order->id }}</td>
    <td><a href="/index/delegate-order/{{ $order->id }}">{{ $order->delegate->name }}</a>
    </td>
    <td>{{ $order->shop_name }}</td>
    <td>{{ $order->customer_address }}</td>
    <td>{{ $order->phone }}</td>
    <td>
        <form action="{{ action('Order\OrderController@destroy', ['id' => $order->id]) }}" method="POST"
            style="width:auto;margin:0px;padding:0px;background:none">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-danger">
            <input delete-id="{{ $order->id }}" type="button" value="Delete Ajax" class="delete-ajax btn btn-danger">
        </form>
    </td>
</tr>
@endforeach
@endsection