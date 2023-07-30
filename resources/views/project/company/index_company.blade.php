@extends('layouts.app')

@section('title', 'Companies Data | Delivery Management')

@section('ajax')
<script>
    function queryBuilderSearch(radioButtonName) {
            $(document).ready(function() {
                var getIdValue = 'filter[' + radioButtonName + ']=';
                $(document).ajaxStart(function() {
                    $('#wait-msg').show();
                });
                $(document).ajaxComplete(function() {
                    $('#wait-msg').hide();
                });
                $('#search').keyup(function() {
                    getIdValue += $(this).val();
                    $.ajax({
                        type: 'get',
                        url: '/index/ajax/company/search',
                        dataType: 'json',
                        data: getIdValue,
                        success: function(data) {
                            $('#tbody-data').empty().html(data.companySection);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
        }
        $(document).ready(function() {
            $('#company-data').DataTable();
            $('.delete-ajax').click(function(e) {
                const buttonId = $(this).attr('delete-id');
                e.preventDefault();
                $.ajax({
                    type: 'delete',
                    url: '/index/ajax/company/' + buttonId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'searchCompany': buttonId
                    },
                    success: function(data) {
                        if (data.status) {
                            $('.row-' + buttonId).remove();
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
<div id="wait-msg" style="display: none;position:absolute;z-index:100000;margin-top: 330px;margin-left: 530px"
    class="spinner-border text-primary" role="status"></div>
</label>
<div class="bg-white">
    <label>
        <div class="ml-3">
            <input type="radio" name="query-builder" id="id" value="id" onchange="queryBuilderSearch(this.value)">
            <label for="id" class="mr-2 cursor-pointer" style="display:inline;margin:0px">Id</label>
            <input type="radio" name="query-builder" id="name" value="name" onchange="queryBuilderSearch(this.value)">
            <label for="name" class="mr-2 cursor-pointer" style="display:inline;margin:0px">Name</label>
            <input type="radio" name="query-builder" id="email" value="email" onchange="queryBuilderSearch(this.value)">
            <label for="email" class="mr-2 cursor-pointer" style="display:inline;margin:0px">Email</label>
            <input type="radio" name="query-builder" id="phone" value="phone" onchange="queryBuilderSearch(this.value)">
            <label for="phone" class="mr-2 cursor-pointer" style="display:inline;margin:0px">Phone</label>
        </div>
        <input type="text" id="search" class="input" placeholder="Search...">
        <div class="line-box">
            <div class="line"></div>
        </div>
        <table class="table table-striped" id="company-data">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Manager Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tbody-data">
                @foreach ($companies as $company)
                <tr class="row-{{ $company->id }}">
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->manager }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>
                        <form action="" style="width:auto;margin:0px;padding:0px;background:none">
                            <input type="button" value="Edit Data" class="btn btn-success"
                                onclick="location.href= '/index/ajax/company/{{ $company->id }}/edit' ">
                            <input type="button" value="Delete Ajax" class="delete-ajax btn btn-danger"
                                delete-id="{{ $company->id }}">
                        </form>
                    </td>
                    @endforeach
            </tbody>
        </table>
</div>
@endsection