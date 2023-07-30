@extends('layouts.app')

@section('title', 'Create Expense | Delivery Management')

@section('ajax')
<script>
    $(document).ready(function() {
            $('#save-ajax').on('click', function(e) {
                const id = parseInt($('#id').val());
                const formData = new FormData($('#ajax')[0]);
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/index/ajax/expense') }}",
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status) {
                            $('#flash-ajax').show();
                            $('#ajax')[0].reset();
                            $('#id').val(id + 1);
                            setTimeout(function() {
                                $('#flash-ajax').hide();
                            }, 6000);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
</script>
@endsection

@section('content')
<form id="ajax" action="{{ url('/index/expense') }}" method="POST">
    @csrf
    <x-flash />
    <div class="alert alert-success" id="flash-ajax" style="display: none">
        <strong>Success</strong><br>
        <span>data saved successfully</span>
    </div>
    <label>
        <span class="label-txt">ID Number</span>
        <input id="id" type="text" id="id" value="{{ \App\Models\Expense::max('id') + 1 }}" name="id"
            class="input text-center text-red-700 font-bold" readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Expense Type</span>
        <input type="text" id="type" value="{{ old('type') }}" name="type" class="input"
            placeholder="Enter Expense Type" autocomplete="off">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('type')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Expense Information</span>
        <input type="text" id="info" value="{{ old('info') }}" name="info" class="input"
            placeholder="Enter Expense Information" autocomplete="off">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('info')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Sum</span>
        <input type="text" id="sum" value="{{ old('sum') }}" name="sum" class="input" placeholder="Enter Sum Of Expense"
            autocomplete="off" maxlength="4">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('sum')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Notes</span>
        <textarea name="notes" id="notes" vlaue="{{ old('notes') }}" placeholder="Enter Expense Notes" class="input"
            style="min-height: 100px;max-height: 200px"></textarea>
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('notes')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <input type="submit" value="Save Data" class="btn btn-success">
    <input type="button" value="Save Data Ajax" id="save-ajax" class="btn btn-success">
</form>
<input type="button" value="Show Expenses Data" class="button btn btn-light" onclick="location.href= '/index/expense' ">
@endsection