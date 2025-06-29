<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MpesaPaymentController extends Controller
{
    public function showForm()
    {
        return view('mpesa.form');
    }

    public function pay(Request $request)
    {
        $url = 'https://api.sandbox.vm.co.mz:18352/ipg/v1x/c2bPayment/singleStage/';

        $headers = [
            'Origin' => '*',
            'apiKey' => 'olsspdy4wdl1towzttmqmvdtibpnrlms',
            'publicKey' => 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r892B6toGzZQVB7qtebH4apDjmvTi5FGZVjVYxalyyQkj4uQbbRQjgCkubSi45Xl4CGtLqZztsKssWz3mcKncgTnq3DHGYYEYiKq0xIj100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==',
        ];

        $payload = [
            'input_TransactionReference' => $request->input('transaction_reference'),
            'input_CustomerMSISDN' => $request->input('customer_msisdn'),
            'input_Amount' => $request->input('amount'),
            'input_ThirdPartyReference' => $request->input('third_party_reference'),
            'input_ServiceProviderCode' => $request->input('service_provider_code'),
        ];

        $response = Http::withHeaders($headers)->asForm()->post($url, $payload);

        return view('mpesa.result', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json(),
        ]);
    }
}
