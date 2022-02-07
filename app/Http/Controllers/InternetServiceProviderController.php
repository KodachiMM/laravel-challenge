<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount()
    {
        $mpt = new Mpt(request('month') ?: 1);
        $amount = $mpt->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }

    public function getOoredooInvoiceAmount()
    {
        $ooredoo = new Ooredoo(request('month') ?: 1);
        $amount = $ooredoo->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }
}
