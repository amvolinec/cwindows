<?php

namespace App\Http\Controllers;

use App\Architect;
use App\Client;
use App\Company;
use App\File;
use App\Http\Requests\OfferRequest;
use App\Offer;
use App\Position;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $offers = Offer::whereNotNull('inquiry_date')->get();
        return view('offer.index', ['offers' => $offers]);
    }

    public function get()
    {
        return Offer::with(['client', 'architect', 'company', 'state', 'files'])->whereNotNull('inquiry_date')->get();

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
     * @param $id
     * @return View
     */
    public function show($id)
    {
        return view('offer.show', ['id' => $id]);
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

    public function setOffer(OfferRequest $request)
    {
        if (!$request->has('id') || (int)$request->get('id') === 0) {
            $offer = new Offer();
        } else {
            $offer = Offer::findOrFail($request->get('id'));
        }

        try {
            $offer->fill($request->except('client_id, manager_id, company_id, positions'));
        } catch (\Exception $exception) {
            return ['status' => 'error', 'message' => 'Fill error: ' . PHP_EOL . $exception->getMessage()];
        }

        if ((int)$request->get('company_id') > 0) {
            $company = Company::find($request->get('company_id'));
            $offer->company_id = (int)$request->get('company_id');
        } else if ($request->has('company_name') && !empty($request->get('company_name'))) {
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

        if ((int)$request->get('manager_id') > 0) {
            $offer->manager_id = (int)$request->get('manager_id');
        } else {
            $offer->manager_id = null;
        }

        $client->save();

        if ($request->hasFile('file')) {

            $file_name = $request->file('file')->getClientOriginalName();

            $this->checkDir();

            try {
                $path = Storage::disk('uploads')->putFile('documents', $request->file('file'));
            } catch (\Exception $exception) {
                return ['status' => 'error', 'message' => 'File save error: ' . PHP_EOL . $exception->getMessage()];
            }

            File::create([
                'file_name' => $file_name,
                'file_uri' => $path,
                'offer_id' => $offer->id
            ]);
        }

        try {
            $offer->save();
        } catch (\Exception $exception) {
            return ['status' => 'error', 'message' => 'Save error: ' . PHP_EOL . $exception->getMessage()];
        }


//        try {
//            $offer->title = $request->get('title');
//            $offer->client_id = $client->id;
//            $offer->state_id = $request->get('state_id');
//            $offer->pipeline = $request->has('pipeline') ? $request->get('pipeline') : '';
//            $offer->planed_date = $request->has('planed_date') ? substr($request->get('planed_date'), 0, 10) : null;
//            $offer->project_amount = $request->has('project_amount') ? (float)$request->get('project_amount') : 0;
//            $offer->planned_amount_percents = $request->has('planned_amount_percents') ? (float)$request->get('planned_amount_percents') : 0;
//            $offer->info = $request->has('info') ? $request->get('info') : '';
//            $offer->user_id = $request->get('user_id');
//            $offer->delivery_address = $request->has('delivery_address') ? $request->get('delivery_address') : '';
//
//            if ($request->has('delivery_date')) {
//                $offer->delivery_date = empty($request->get('delivery_date')) ? null : substr($request->get('delivery_date'),0,10);
//            }
//
//            if ($request->has('number')) {
//                $offer->number = $request->get('number');
//            }
//            if ($request->has('order_number')) {
//                $offer->order_number = $request->get('order_number');
//            }
//            if ($request->has('total')) {
//                $offer->total = $request->get('total');
//            }
//            if ($request->has('total_with_vat')) {
//                $offer->total_with_vat = $request->get('total_with_vat');
//            }
//            if ($request->has('sales_profit')) {
//                $offer->sales_profit = $request->get('sales_profit');
//            }
//
//            $offer->save();
//
//            if ($request->has('positions')) {
//
//                $positions = $request->get('positions');
//
//                if (!empty($positions)) {
//                    foreach ($positions as $position) {
//
//                        if (is_array($position)) {
//
//                            if (!isset($position['id'])) {
//                                $item = new Position();
//                            } else {
//                                $item = Position::find($position['id']);
//                            }
//
//                            $item->title = $position['title'];
//                            $item->quantity = $position['quantity'];
//                            $item->cost = $position['cost'];
//                            $item->price = $position['price'];
//                            $item->discount = $position['discount'];
//                            $item->discount_next = $position['discount_next'];
//                            $item->final_price = $position['final_price'];
//                            $item->subtotal = $position['subtotal'];
//                            $item->total = $position['total'];
//                            $item->vat = $position['vat'];
//                            $item->offer_id = $offer->id;
//
//                            $item->save();
//                        } else {
//                            Log::info("Position is not an Array ");
//                        }
//                    }
//                }
//
//            }
//
//        } catch (\Exception $exception) {
//            return ['status' => 'error', 'message' => $exception->getMessage()];
//        }

        if ($request->has('positions') && !empty($request->get('positions'))) {

            $positions = $request->get('positions');

            if (!empty($positions) && sizeof($positions) > 0) {
                foreach ($positions as $position) {

                    if (is_array($position)) {

                        if (!isset($position['id'])) {
                            $item = new Position();
                        } else {
                            $item = Position::find($position['id']);
                        }

                        if (!empty($position['quantity'])) {
                            $item->title = $position['title'];
                            $item->quantity = $position['quantity'];
                            $item->cost = $position['cost'];
                            $item->price = $position['price'];
                            $item->discount = $position['discount'];
                            $item->discount_next = $position['discount_next'];
                            $item->final_price = $position['final_price'];
                            $item->subtotal = $position['subtotal'];
                            $item->total = $position['total'];
                            $item->vat = $position['vat'];
                            $item->offer_id = $offer->id;

                            $item->save();
                        }

                    } else {
                        Log::info("Position is not an Array ");
                    }
                }
            }

        }

        return [
            'status' => 'success',
            'message' => json_encode($company),
            'offer' => $this->getData($offer->id)
        ];
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

    public function getData($id)
    {
        return Offer::with(['client', 'architect', 'company', 'state', 'positions', 'user', 'files'])->findOrFail($id);
    }

    public function createOffer()
    {
        $offer = Offer::whereNull('inquiry_date')->get()->first();
        if (!$offer) {
            $offer = new Offer();
        }
        $offer->user_id = Auth::user()->id;
        $offer->created_at = date('Y-m-d H:i:s');
        $offer->save();
        return ['offer' => $offer];
    }

    protected function checkDir()
    {
        $is_exist = Storage::disk('uploads')->exists('documents');

        if (!$is_exist) {
            try {
                Storage::disk('uploads')->makeDirectory('documents');
            } catch (Exception $e) {
                return ['status' => 'error', 'message' => $e->getMessage()];
            }
        }
    }
}
