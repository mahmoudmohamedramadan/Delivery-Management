<?php

namespace App\Http\Controllers\Payment;

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\CarTransactoin;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index($id)
    {
        $car_transactoin_id = CarTransactoin::find($id);

        if ($id != Car::max('id') + 1) {
            abort(405, 'You can not pay for this car or this car is already paid');
        }

        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatus(request()->resourcePath);
            
            if (isset($payment_status['id'])) {
                // $showSuccessPaymentMessage = true;
                CarTransactoin::create([
                    'car_id'         => Car::max('id') + 1,
                    'transaction_id' => $payment_status['id']
                ]);

                Alert::success('Success', 'success transaction');
                return view('project.car.create_car')->with([
                    'error' => false,
                    'payment_error' => false,
                    'mechanics' => Mechanic::all(),
                ]);
            }
            // $showFailPaymentMessage = true;
            Alert::error('Insuccess', 'invalid transaction');
        }
        
        return view('project.car.payment_car');
    }

    // test card number is >> 4200 0000 0000 0000
    public function getCheckOutId(...$vars)
    {
        if (!$vars[1]) {
            Alert::error('Insuccess', 'can not identify car price');
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
        curl_setopt(
            $ch,
            CURLOPT_SSL_VERIFYPEER,
            false
        ); // this should be set to true in production
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

    private function getPaymentStatus($resourcePath)
    {
        $url = "https://test.oppwa.com/" . $resourcePath . "?entityId=8a8294174b7ecb28014b9699220015ca";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt(
            $ch,
            CURLOPT_SSL_VERIFYPEER,
            false
        ); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);

        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);
        return json_decode($responseData, true);
    }
}
