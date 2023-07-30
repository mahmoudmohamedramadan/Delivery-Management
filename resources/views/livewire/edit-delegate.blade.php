@section('title') Edit {{ $name }} | Delivery Management @endsection

<form wire:submit.prevent="update({{ $delegate_id }})">
    <label>
        <span class="label-txt">ID Number</span>
        <input type="text" value="{{ $delegate_id }}" class="input text-center
    text-red-600 font-bold" readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Name</span>
        <input type="text" wire:model.lazy="name" class="input" autocomplete="off" placeholder="Enter Full Name">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('name')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">National ID</span>
        <input type="text" wire:model.lazy="national_id" class="input" autocomplete="off"
            placeholder="Enter National ID" maxlength="16">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('national_id')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Phone Number</span>
        <input type="text" wire:model.lazy="phone" class="input" autocomplete="off" placeholder="Enter Phone Number"
            maxlength="11">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('phone')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Motor Size</span>
        <input type="text" wire:model.debounce.800ms="motor_size" class="input" autocomplete="off"
            placeholder="Enter Motor Size" maxlength="4">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('motor_size')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <div class="input-group">
            <select class="custom-select" wire:model.lazy="car_id">
                <option value="{{ $car_id['id'] }}">{{ $car_id['type'] }}</option>
                @foreach ($cars as $car)
                <option value="{{ $car->id }}">{{ $car->type }}</option>
                @endforeach
            </select>
        </div>
    </label>
    <label>
        <span class="label-txt">Made Date</span>
        <input type="date" wire:model.lazy="made_date" class="input" autocomplete="off">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('made_date')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <img class="mt-2" src="/images/delegate/{{ $image }}" alt="{{ $image }}" width="80px" height="80px">
    </label>
    <div style="margin-top: 30px">
        <input type="submit" value="Edit Data Livewire" class="btn btn-success">
    </div>
</form>

<!--
 notice that you shouldn't have to extend layouts/app.blade.php because
 livewire by default extends this file and you can customize it, so here you
 shouldn't have also make section directive that yields content because
 livewire let you write name of section after writing livewire as channing
 method route and this in case you have on yield only in app.blade.php
 but when you have more than yield directives you should specify this
 section scopes here for example >> when you want to take m yield directives
 from app.blade.php you will write m section channing method in livewire route
 and you should specify (m-1) section directives here
 ==============================================================
 ex: you want to yield two yields in app.blade.php specify write two section
 method in livewire route and write here one section directive
 -->

<!--
 notice that livewire doesn't support post/patch..etc eactions like memic form
 but should bind/syncronize form's input with component's property to share
 data between them.
-->