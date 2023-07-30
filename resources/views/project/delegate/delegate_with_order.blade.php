@extends('layouts.app')

@section('title', 'Delegates With Orders | Delivery Management')

@section('content')
<div class="mb-5">
    <div class="alert alert-success" style="display: none" id="flash-ajax">
        <strong>Success</strong><br>
        <span>delegate deleted successfully</span>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">National ID</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Delegate Image</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($delegateWithOrders as $delegate_orders)
            <tr id="row_id">
                <td>{{ $delegate_orders->id }}</td>
                <td><a href="/index/delegate/{{ $delegate_orders->id }}">{{ $delegate_orders->full_name }}</a>
                </td>
                <td>{{ $delegate_orders->national_id }}</td>
                <td>{{ $delegate_orders->phone_number }}</td>
                @if ($delegate_orders->delegate_image)
                <td><img src="{{ asset('images/delegate/' . $delegate_orders->delegate_image) }}"
                        alt="{{ $delegate_orders->delegate_image }}" width="80px" height="80px"></td>
                @include('project.layouts.layout',['delegate' => $delegate_orders,'filter' => $filter])
                @else
                <td><span class="text-red-600">there is no image</span></td>
                @include('project.layouts.layout',['delegate' => $delegate_orders,'filter' => $filter])
                @endif
            </tr>
            <tr>
                @foreach ($delegate_orders->orders as $order)
                <td>{{ $order->shop_name }}</td>
                <td>{{ $order->customer_address }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->order_fees }}</td>
                <td>{{ $order->delivery_value }}</td>
                <td>{{ $order->delivery_date }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection