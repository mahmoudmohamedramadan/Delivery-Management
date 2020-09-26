@extends('layouts.app')@section('title', 'Delegate\'s Data | Delivery Management')
@section('ajax')
    <script>
        $(document).ready(function() {
            $('#delegate-data').DataTable();
            $(document).ajaxStart(function() {
                $('#wait-msg').show();
            });
            $(document).ajaxComplete(function() {
                $('#wait-msg').hide();
            });
            $('#filter-delegate').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ action([\App\Http\Controllers\Delegate\DelagateDBRelation::class, 'DelegateOrderRelation']) }}',
                    type: 'post',
                    dataType: 'json',
                    data: $('#frm-filter').serialize(),
                    success: function(data) {
                        $('#table-body').empty().html(data.delegate_rows);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });
            $('.delete-ajax').on('click', function(e) {
                const id = $(this).attr('delete-id');
                e.preventDefault();
                $.ajax({
                    type: 'DELETE',
                    url: '/index/ajax/delegate/' + id,
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('.row-' + id).remove();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'get',
                    url: '/index/search/delegate',
                    data: {
                        searchVal: $(this).val()
                    },
                    success: function(data) {
                        $('#search-result').show();
                        $('#search-result').empty().html(data.searchSection);
                    },
                    error: function(data) {
                        console.log(data)
                    }
                });
            });
            $('.report').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/index/ajax/delegate-report',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'delegate_table': $('#delegate-table').html()
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });
        });
        $(document).on('mouseover', 'li', function() {
            $('#search').val($(this).text());
            $(this).css('background-color', '#CCC');
        });
        $(document).on('mouseleave', 'li', function() {
            $(this).css('background-color', '#FFF');
        });
        $(document).on('click', 'li', function() {
            $('#search').val($(this).text());
            $('#search-result').hide();
        });

    </script>
@stop
@section('content')
    @if ($delegates->count() > 0)
        <div id="wait-msg" style="display: none;position:absolute;z-index:
            100000;margin-top: 330px;margin-left: 530px" class="spinner-border
            text-primary" role="status"></div>
        <form action="" id="frm-filter"
            style="width:920px;padding:5 5 15 5;background:#efefef;margin-left:70px;margin-bottom:60px;margin-top:10px;float:left">
            @csrf
            <h1 class="font-bold text-lg text-gray-600 py-4">Choose Fit Filter</h1>
            <input type="radio" name="filter" value="0" id="no-filter" checked>
            <label for="no-filter" class="mr-2 cursor-pointer" style="display:inline;margin:0px">None</label>
            <input type="radio" name="filter" value="1" id="delegate-has">
            <label for="delegate-has" class="mr-2 cursor-pointer" style="display:inline;margin:0px">Delegates Has
                Orders</label>
            <input type="radio" name="filter" value="2" id="delegate-with-orders">
            <label for="delegate-with-orders" class="mr-2 cursor-pointer" style="display:inline;margin:0px">Delegates With
                Orders</label>
            <input type="radio" name="filter" value="3" id="delegate-doesnt-have">
            <label for="delegate-doesnt-have" class="cursor-pointer" style="display:inline;margin:0px">Delegates Doesnt Have
                Orders</label><br>
            <input type="submit" value="Apply Filter" class="mt-3 btn btn-dark" id="filter-delegate">
            <label>
                <input type="text" id="search" class="input" placeholder="Search...">
                <div style="float:left;display:none" id="search-result"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </label>
        </form>
        <div id="delegate-table" class="bg-white">
            <table class="table" id="delegate-data">
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
                <tbody id="table-body">
                    {!! $delegate_rows !!}
                </tbody>
            </table>
            <input type="button" class="report btn btn-dark ml-5 mb-3" value="Report Delegate's Data">
        </div>
    @else
        <div class="alert alert-warning">
            <strong>Warning</strong><br>
            <span>there is no any delegate until now,</span><a href="/index/delegate/create" class="underline ml-2">create
                new one</a>
        </div>
    @endif
@endsection
