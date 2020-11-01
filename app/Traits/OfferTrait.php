<?php

namespace App\Traits;

use App\Offer;
use App\Tender;
use Exception;

trait OfferTrait
{
    protected $offer;
    protected $tender;

    protected function setVersion($tender_id)
    {
        $this->tender = Tender::with('positions', 'files')->findOrFail($tender_id);
        $this->offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $this->tender->offer_id)->get()->first();

        if($this->offer->version === $this->tender->version){
            return ['offer' => $this->offer];
        }

        $this->unsetPositions();

        $this->offer->manager_id = $this->tender->manager_id;
        $this->offer->delivery_address = $this->tender->delivery_address;
        $this->offer->version = $this->tender->version;
        $this->offer->profile_id = $this->tender->profile_id;
        $this->offer->materials = $this->tender->materials;
        $this->offer->colors = $this->tender->colors;
        $this->offer->squaring = $this->tender->squaring;
        $this->offer->total = $this->tender->total;
        $this->offer->total_with_vat = $this->tender->total_with_vat;
        $this->offer->cost = $this->tender->cost;
        $this->offer->expenses = $this->tender->expenses;
        $this->offer->comment = $this->tender->comment;

        $this->offer->save();

        $this->setPositions();

        $this->offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $this->tender->offer_id)->get()->first();
        return ['offer' => $this->offer];
    }

    protected function unsetPositions()
    {
        foreach ($this->offer->positions as $position) {
            $position->offer()->dissociate();
            $position->save();
        }
    }

    protected function setPositions()
    {
        foreach ($this->tender->positions as $position) {
            $this->offer->positions()->save($position);
            $this->offer->save();
        }
    }

}
