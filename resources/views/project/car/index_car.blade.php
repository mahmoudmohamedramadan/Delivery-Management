@extends('layouts.app')@section('title', 'Car\'s Data | Delivery Management')
@section('ajax')
    <script>
        $(document).ready(function() {
            $('#car-data').DataTable();
            $('.delete-ajax').on('click', function(e) {
                const id = $(this).attr('delete-id');
                e.preventDefault();
                $.ajax({
                    type: 'DELETE',
                    url: '/index/ajax/mechanic/' + id,
                    data: {
                        '_token': '{{ csrf_token() }}',
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
        });

    </script>
@stop
@section('content')
    <div class="bg-white">
        <table class="table table-striped" id="car-data">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Car Type</th>
                    <th scope="col">Car Char</th>
                    <th scope="col">Car Number</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr class="row-{{ $car->id }}">
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->type }}</td>
                        <td>{{ $car->char }}</td>
                        <td>{{ $car->number }}</td>
                        <td>
                            <form action="/index/car/{id}" method="GET"
                                style="width:auto;margin:0px;padding:0px;background:none">
                                @method('DELETE')
                                <input type="button" value="Edit Data" class="btn btn-success"
                                    onclick="location.href= '/index/car/{{ $car->id }}/edit' ">
                                <input type="submit" value="Delete" class="btn btn-danger">
                                <input type="button" value="Delete Ajax" class="delete-ajax btn btn-danger"
                                    delete-id="{{ $car->id }}">
                            </form>
                        </td>
                @endforeach
            </tbody>
        </table>
        <div>
        @endsection
