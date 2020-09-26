@extends('layouts.app')
@section('title', 'Expense\'s Data | Delivery Management')
@section('ajax')
    <script>
        $(document).ready(function() {
            $('#expense-data').DataTable();
            $('.delete-ajax').on('click', function() {
                var id = $(this).attr('delete-id');
                $.ajax({
                    type: 'DELETE',
                    url: '/index/ajax/expense/' + id,
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
        });

    </script>
@stop
@section('content')
    @if ($expenses->count() > 0)
        <div class="bg-white">
            <table class="table" id="expense-data">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Expense Type</th>
                        <th scope="col">Expense Information</th>
                        <th scope="col">Expense Sum</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr class='row-{{ $expense->id }}'>
                            <td>{{ $expense->id }}</td>
                            <td><a href="/index/expense/{{ $expense->id }}">{{ $expense->type }}</a></td>
                            <td>{{ $expense->info }}</td>
                            <td>{{ $expense->sum }}</td>
                            <td>
                                <form action="{{ action('Expense\ExpenseController@destroy', ['id' => $expense->id]) }}"
                                    method="POST" style="width:auto;margin:0px;padding:0px;background:none">
                                    @csrf
                                    @method('DELETE')
                                    <input type="button" value="Edit Data" class="btn btn-success"
                                        onclick="location.href = '/index/expense/{{ $expense->id }}/edit' ">
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                    <input delete-id="{{ $expense->id }}" type="button" value="Delete Ajax"
                                        class="delete-ajax btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning">
            <strong>Warning</strong><br>
            <span>there is no any expense untill now,</span><a href="/index/expense/create" class="underline ml-2">add new
                one</a>
        </div>
    @endif
@endsection
