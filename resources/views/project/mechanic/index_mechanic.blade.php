@extends('layouts.app')@section('title', 'Mechanic\'s Data | Delivery Management')
@section('ajax')
    <script>
        $(document).ready(function() {
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

@push('scripts')
    <script>
       $(document).ready(function() {
         $('#mechanic-data').DataTable();
       });

    </script>
@endpush

@section('content')
    @if ($mechanics->count() > 0)
        <div class="bg-white">
            <table class="table" id="mechanic-data">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mechanic Name</th>
                        <th scope="col">Mechanic Address</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mechanics as $mechanic)
                        <tr class="row-{{ $mechanic->id }}">
                            <td>{{ $mechanic->id }}</td>
                            <td>{{ $mechanic->name }}</td>
                            <td>{{ $mechanic->address }}</td>
                            <td>
                                <form action="/index/mechanic/{id}" method="GET"
                                    style="width:auto;margin:0px;padding:0px;background:none">
                                    @method('DELETE')
                                    <input type="button" value="Edit Data" class="btn btn-success"
                                        onclick="location.href= '/index/mechanic/{{ $mechanic->id }}/edit' ">
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                    <input type="button" value="Delete Ajax" class="delete-ajax btn btn-danger"
                                        delete-id="{{ $mechanic->id }}">
                                </form>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning">
            <strong>Warning</strong><br>
            <span>there is no any mechanic untill now,</span><a href="/index/mechanic/create" class="underline ml-2">add new
                eone</a>
        </div>
    @endif
@endsection
