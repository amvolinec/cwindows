<?php

namespace App\Traits;

use App\File;
use App\Offer;
use App\Tender;
use Exception;

trait TenderTrait
{
    public function makeVersion($offer_id, $files)
    {
        $offer = Offer::with('positions', 'files')->findOrFail($offer_id);
        $this->makeNewTender($offer, $files);
    }

    protected function makeNewTender(Offer $offer, $files)
    {
        if (empty($offer->manager_id)) throw new Exception('Manager not defined');
        if (empty($offer->profile_id)) throw new Exception('Profile not defined');

        if (empty($offer->positions)) throw new Exception('Empty items count');

        $tender = Tender::create([
            'offer_id' => $offer->id,
            'manager_id' => (int)$offer->manager_id,
            'delivery_address' => $offer->delivery_address ?? '',
            'version' => $offer->version,
            'profile_id' => $offer->profile_id ?? null,
            'materials' => $offer->materials ?? '',
            'colors' => $offer->colors ?? '',
            'squaring' => $offer->squaring ?? '',
            'total' => $offer->total,
            'total_with_vat' => $offer->total_with_vat,
            'cost' => $offer->cost,
            'expenses' => $offer->expenses,
            'comment' => $offer->comment,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $tender->positions()->sync($offer->positions_ids);

        $positions = $offer->positions;

        foreach ($positions as $position) {
            $new = $position->replicate();
            $new->push();

            $position->offer_id = null;
            $position->save();
        }

        $tender->files()->sync($files);

        $offer->save();
    }
}
