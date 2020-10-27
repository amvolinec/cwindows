<?php

namespace App\Traits;

use App\Offer;
use App\Tender;
use Exception;

trait OfferTrait
{
    protected $offer;
    protected $tender;

    protected function setVersion(Offer $offer, Tender $tender)
    {
        $this->offer = $offer;
        $this->tender = $tender;
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

        $this->unsetPositions();
//        $this->unsetFiles();

//        $this->setFiles();

        return $this->offer;
    }

    protected function unsetPositions(){
        foreach($this->offer->positions as $position){
            $position->offer_id = null;
            $position->save();
        }
    }

//    protected function unsetFiles(){
//        foreach($this->offer->files as $file){
//            $file->offer_id = null;
//            $file->save();
//        }
//    }

    protected function setPositions(){
        foreach($this->tender->positions as $position){
            $position->offer_id = $this->offer->id;
            $position->save();
        }
    }

//    protected function setFiles(){
//        foreach($this->tender->files as $file){
//            $file->offer_id = $this->offer->id;
//            $file->save();
//        }
//    }

}
