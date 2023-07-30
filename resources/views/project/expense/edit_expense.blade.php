@extends('layouts.app')

<title>Edit {{ $expense->type }} | Delivery Management</title>

@section('ajax')
<script>
    $(document).ready(function() {
            $('#edit-ajax').click(function() {
                $.ajax({
                    url: '/index/expense/' + $('#id').val(),
                    type: 'patch',
                    dataType: 'json',
                    data: $('form').serialize(),
                    success: function() {
                        top.location.href = '/index/expense';
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
<form action="/index/expense/{{ $expense->id }}" method="POST">
    @csrf
    @method('patch')
    <x-flash />
    <label>
        <span class="label-txt">Expense Number</span>
        <input type="text" id="id" value="{{ $expense->id }}" class="input text-center text-red-700 font-bold" readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('id')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Expense Type</span>
        <input type="text" value="{{ $expense->type ?? old('type') }}" name="type" class="input"
            placeholder="Enter Expense Type">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('type')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Expense Information</span>
        <input type="text" value="{{ $expense->info ?? old('info') }}" name="info" class="input"
            placeholder="Enter Expense Information">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('info')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Sum</span>
        <input type="text" value="{{ $expense->sum ?? old('sum') }}" name="sum" class="input"
            placeholder="Enter Sum Of Expense" max="4">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('sum')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Notes</span>
        <textarea name="notes" placeholder="Enter Expense Notes" class="input"
            style="min-height: 100px;max-height: 200px">{{ $expense->notes ?? old('notes') }}</textarea>
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('notes')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <div class="mt-10">
        <input type="submit" value="Edit Data" class="btn btn-success">
        <input type="button" value="Edit Data Ajax" id="edit-ajax" class="btn btn-success">
    </div>
</form>
@endsection