@extends('layouts.app')

@section('title', 'Notifications | Delivery |Management')

@section('main')
@if ($notifications->count() > 0)
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2" style="text-align: center">Contact Notifications</th>
            <th colspan="2">
                <form action="/index/{{ Auth::id() }}/notifications" method="POST"
                    style="width:auto;margin:0;padding:0;background:none;float:right">
                    @csrf
                    @method('delete')

                    <input type="submit" value="Remove All" class="btn btn-danger">
                </form>
            </th>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Sender Name</th>
            <th scope="col">Sender Email</th>
            <th scope="col">Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($notifications as $notification)
        <tr>
            <td>{{ $notification->notifiable_id }}</td>
            <td>{{ $notification->data['name'] }}</td>
            <td>{{ $notification->data['email'] }}</td>
            <td>{{ $notification->data['message'] }}</td>
        </tr>
        @endforeach
    </tbody>
    @else
    <div class="alert alert-warning">
        <strong>Warning</strong><br>
        <span>there is no any notifications until now</span>
    </div>
    @endif
    @endsection