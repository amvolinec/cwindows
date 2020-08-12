<?php

namespace App\Http\Controllers;

use App\Architect;
use App\Client;
use App\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $offers = Offer::all();
        return view('offer.index', ['offers' => $offers]);
    }

     public function get()
    {
        return Offer::with(['client', 'architect'])->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('offer.create', ['clients' => Client::all(), 'architects' => Architect::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Offer::create($request->except('_method', '_token'));
        return redirect()->route('offer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Offer  $offer
     * @return RedirectResponse
     */
    public function show(Offer $offer)
    {
        return redirect()->route('offer.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Offer  $offer
     * @return View
     */
    public function edit(Offer $offer)
    {
        return view ('offer.create' , ['offer' => $offer, 'clients' => Client::all(), 'architects' => Architect::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Offer  $offer
     * @return RedirectResponse
     */
    public function update(Request $request, Offer $offer)
    {
        $offer->fill($request->except('_method', '_token'))->save();
        return redirect()->route('offer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Offer  $offer
     * @return RedirectResponse
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offer.index');
    }
}
