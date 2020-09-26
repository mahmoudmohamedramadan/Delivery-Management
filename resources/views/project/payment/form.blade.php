@section('main')
    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $responseData['id'] }}"></script>
    <form action="/index/car-payment/{{$id}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
@stop
