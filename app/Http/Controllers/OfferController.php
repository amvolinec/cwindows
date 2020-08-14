<?php

namespace App\Http\Controllers;

use App\Architect;
use App\Client;
use App\Company;
use App\Offer;
use Exception;
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
        return Offer::with(['client', 'architect', 'company'])->get();

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
     * @param Request $request
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
     * @param Offer $offer
     * @return RedirectResponse
     */
    public function show(Offer $offer)
    {
        return redirect()->route('offer.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Offer $offer
     * @return View
     */
    public function edit(Offer $offer)
    {
        return view('offer.create', ['offer' => $offer, 'clients' => Client::all(), 'architects' => Architect::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Offer $offer
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
     * @param Offer $offer
     * @return RedirectResponse
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offer.index');
    }

    public function setOffer(Request $request)
    {
        if(!$request->has('id') || (int)$request->get('id') === 0){
            $offer = new Offer();
        } else {
            $offer = Offer::findOrFail($request->get('id'));
        }


        if ((int)$request->get('company_id') > 0) {

            $company = Company::find($request->get('company_id'));
            $offer->company_id = (int)$request->get('company_id');

        } else if ($request->has('company_name')) {

            $company = Company::create(['name' => $request->get('company_name')]);
            $offer->company_id = $company->id;

        } else {
            $company = null;
        }

        if ($request->get('client_id') > 0) {
            $client = Client::find($request->get('client_id'));
        } else if (!empty($request->get('client_name'))) {
            $client = Client::create(['name' => $request->get('client_name')]);

            if (!empty($company)) {
                $client->company_id = $company->id;
            }

        } else {
            return ['status' => 'error', 'message' => 'Client not defined!'];
        }

        if (!$request->has('title')) {
            return ['status' => 'error', 'message' => 'Title not defined!'];
        }

        $client->save();

        try {
            $offer->title = $request->get('title');
            $offer->client_id = $client->id;
            $offer->state_id = $request->get('state_id');
            $offer->pipeline = $request->has('pipeline') ? $request->get('pipeline') : '';
            $offer->planed_date = $request->has('planed_date') ? substr($request->get('planed_date'), 0, 10) : null;
            $offer->project_amount = $request->has('project_amount') ? (float)$request->get('project_amount') : 0;
            $offer->planned_amount_percents = $request->has('planned_amount_percents') ? (float)$request->get('planned_amount_percents') : 0;
            $offer->info = $request->has('info') ? $request->get('info') : '';
            $offer->user_id = $request->get('user_id');

            $offer->save();

        } catch (\Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }

        return ['status' => 'success', 'message' => json_encode($company)];
    }

    public function deleteMany(Request $request)
    {
        try {
            Offer::where('id', $request->get('id'))->delete();

            return ['status' => 'success'];

        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
