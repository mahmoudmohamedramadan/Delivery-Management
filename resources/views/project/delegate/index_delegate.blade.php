@extends('layouts.app')

@section('title', 'Delegate\'s Data | Delivery Management')

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
                    url: '/index/ajax/search/delegate',
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
        $(document).on('mouseover', '.li-delegate-name', function() {
            $('#search').val($.trim($(this).text()));
            $(this).css('background-color', '#CCC');
        });
        $(document).on('mouseleave', '.li-delegate-name', function() {
            $('#search').val('');
            $(this).css('background-color', '#FFF');
        });
        $(document).on('click', '.li-delegate-name', function() {
            $('#search').val($.trim($(this).text()));
            $('#search-result').hide();
        });
</script>
@stop

@section('content')
@if ($delegates->count() > 0)
<div id="wait-msg" style="display: none;position:absolute;z-index:
                100000;margin-top: 330px;margin-left: 530px" class="spinner-border
            text-primary" role="status">
</div>
<div id="delegate-table" class="bg-white">
    <labe>
        <input type="text" id="search" class="input" placeholder="Search...">
        <div style="float:left;display:none" id="search-result"></div>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </labe>
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