<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

class PaymentController extends Controller {
  public function index($id) {
    if ($id != \App\Models\Car::max('id') + 1) {
      return abort(404);
    }
    if (request('id') && request('resourcePath')) {
      $payment_status = $this->getPaymentStatus(request('id'),
        request('resourcePath'));
      if (isset($payment_status['id'])) {
        $showSuccessPaymentMessage = true;
        \App\Models\CarTransactoin::create([
          'car_id'         => \App\Models\Car::max('id') + 1,
          'transaction_id' => $payment_status['id']
        ]);
        return view('project.car.create_car')->with([
          'error' => false, 'payment_error' => false
        ]);
      }
      $showFailPaymentMessage = true;
      return view('project.car.payment_car')->with(['error' => 'fail transaction']);
    }
    return view('project.car.payment_car');
  }

  //test card number is >> 4200 0000 0000 0000
  public function getCheckOutId($id, $price) {
    if (!$price) {
      return abort(404);
    }
    $url = "https://test.oppwa.com/v1/checkouts";
    $data = "entityId=8a8294174b7ecb28014b9699220015ca" . "&amount=" . request()->price . "&currency=EUR" . "&paymentType=DB";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,
      false); // this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if (curl_errno($ch)) {
      return curl_error($ch);
    }
    curl_close($ch);
    $result = json_decode($responseData, true);
    $view = view('project.payment.form')->with([
      'responseData' => $result, 'id' => request()->id
    ])->renderSections();
    return response()->json([
      'status' => true, 'content' => $view['main']
    ]);
  }

  private function getPaymentStatus($id, $resourcepath) {
    $url = "https://test.oppwa.com/";
    $url .= $resourcepath;
    $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='
    ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,
      false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if (curl_errno($ch)) {
      return curl_error($ch);
    }
    curl_close($ch);
    return json_decode($responseData, true);
  }
}
