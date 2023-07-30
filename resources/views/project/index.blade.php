@extends('layouts.app')

@section('content')
<form style="padding: 20">
    <h2 class="text-gray-600 font-bold text-center">Welcome with you to my system</h2>
    <label>
        <p class="text-gray-700 font-bold text-lg">here you can <a style="text-decoration: underline"
                href="/index/delegate/create">create new delegate</a> who arrives orders, so you can <a
                style="text-decoration: underline" href="/index/order/creae">create new order</a> also <a
                style="text-decoration: underline" href="/index/car/create">create new car</a> which arrives delegate
            but at
            the first you should buy car using HyperPay Gateway and if this car work down at any time you should go to
            mechanic to fix it so you can <a style="text-decoration: underline" href="/index/mechanic/create">create new
                mechanic</a> which you deal with him also you may buy new product from any company so you can <a
                style="text-decoration: underline" href="/index/ajax/company/create">create new company</a> ,also
            provided
            here actions of edit and delete an data you want</p>
    </label>
    <label>
        <h2 class="text-red-600 font-bold">Technologies Which I Use</h2>
        <ul>
            <li class="font-bold">Laravel Framework</li>
            <li class="font-bold">Ajax</li>
            <li class="font-bold">Livewire</li>
            <li class="font-bold">Vue.js</li>
            <li class="font-bold">JavaScript</li>
            <li class="font-bold">Tailwind.css</li>
        </ul>
    </label>
</form>
@endsection