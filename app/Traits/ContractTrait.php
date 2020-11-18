<?php

namespace App\Traits;

use App\Contract;
use App\Offer;

trait ContractTrait
{
    public function makeNewContract($offer_id)
    {
        $contract = null;

        $offer = Offer::with('positions', 'files')->findOrFail($offer_id);

        if(isset($offer)){
            $contract = Contract::where('offer_id',$offer_id)->first();

            $data = [
                'offer_id' => $offer->id,
                'manager_id' => $offer->manager_id ?? null,
                'client_id' => $offer->client_id ?? null,
                'company_id' => $offer->company_id ?? null,
                'address' => $offer->delivery_address ?? null,
                'margin' => $offer->margin ?? 0,
                'expenses' => $offer->expenses ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if($offer->maintenance_id !== null && $offer->maintenance_id !== 0) {
                $data['maintenance_id'] = $offer->maintenance_id;
            }

            if(!$contract) {
                $contract = Contract::create($data);
            }
        }

        return $contract;
    }
}
