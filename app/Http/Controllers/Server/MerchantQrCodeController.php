<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerchantQrCodeController extends Controller
{
    public function show(Request $request, $id)
    {
        return  view("merchant-qr-code.merchant-qr-code-show", [
            'id' => $id
        ]);
    }
}
