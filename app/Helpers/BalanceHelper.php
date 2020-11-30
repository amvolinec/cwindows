<?php


namespace App\Helpers;

use App\Offer;
use Illuminate\Support\Facades\Log;

class BalanceHelper
{
    public static function calc(Offer $offer)
    {
        $balance = 0;
        foreach ($offer->transactions as $transaction) {
            $balance += $transaction->amount;
        }
        $offer->balance = $balance - $offer->total;
        return $balance - $offer->total_with_vat;
    }
}
