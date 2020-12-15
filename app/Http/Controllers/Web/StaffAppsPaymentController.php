<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffAppsPaymentController extends Controller
{
    public function show($appId, $paymentId)
    {
        return view('apps.apps-payments-show', [
            'appId' => $appId,
            'paymentId' => $paymentId,
        ]);
    }
}
