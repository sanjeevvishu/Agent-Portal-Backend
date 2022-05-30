<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\CurrencyExchangeRate;

class ExchangeRatesController extends Controller
{   
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        /*
        "data": {
            "base": "USD",
            "USD": 1,
            "TRY": 14.964595,
            "usd_to_try": 14.964595,
            "try_to_usd": 0.06682439451251437
        }
        */
        $currencyExchangeRate = CurrencyExchangeRate::select('base','USD','TRY','created_at')->selectRaw('TRY/USD as usd_to_try')->selectRaw('USD/TRY as try_to_usd')->latest()->first();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $currencyExchangeRate
        ], 200);
    }
}
