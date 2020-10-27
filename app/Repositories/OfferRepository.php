<?php


namespace App\Repositories;


use App\Offer;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\State;
use App\Tender;
use App\Traits\SettingTrait;
use App\TransactionType;

class OfferRepository implements OfferRepositoryInterface
{
//    use SettingTrait;

    public function all($request)
    {
        Offer::whereNotNull('inquiry_date')->where('setting_id', $request->user()->setting_id)->get();
    }

    public function get($request)
    {
        return Offer::with(
            'client',
            'architect',
            'company',
            'state',
            'user',
            'positions',
            'manager',
            'files',
            'color',
            'material',
            'editor',
            'maintenance',
            'tenders'
        )->whereNotNull('inquiry_date')->where('setting_id', $request->user()->setting_id)->get();
    }

    public function getLastNumber($request)
    {
        return (int)Offer::whereNotNull('inquiry_date')
            ->where('setting_id', $request->user()->setting_id)
            ->orderBy('number', 'desc')
            ->pluck('number')->first();
    }

    public function getNewNumber($request)
    {
        $last = $this->getLastNumber($request);
        return ++$last;
    }

    public function getData($id)
    {
        return [
            'offer' => Offer::with([
                'client',
                'architect',
                'company',
                'state',
                'positions',
                'user',
                'files',
                'manager',
                'color',
                'material',
                'editor',
                'maintenance',
                'transactions',
                'tenders'])
                ->findOrFail($id),
            'states' => State::all(),
            'types' => TransactionType::all(),
            'tenders' => Tender::with('positions', 'files')->where('offer_id','=', $id)->get()
        ];
    }
}
