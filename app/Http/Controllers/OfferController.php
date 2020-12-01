<?php

namespace App\Http\Controllers;

use App\Architect;
use App\Client;
use App\Company;
use App\File;
use App\Helpers\BalanceHelper;
use App\Http\Requests\OfferRequest;
use App\Offer;
use App\Position;

use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Setting;
use App\State;
use App\Tender;
use App\Traits\SettingTrait;
use App\Traits\TenderTrait;
use App\TransactionType;
use App\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use NumberFormatter;

class OfferController extends Controller
{
    protected $repo;

    use TenderTrait;
    use SettingTrait;

    public function __construct(OfferRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('offer.index', ['offers' => $this->repo->all($request)]);
    }

    public function get(Request $request)
    {
        return $this->repo->get($request);
    }

    public function getData($id)
    {
        return $this->repo->getData($id);
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

        $offers = Offer::create($request->except('_method', '_token'));
        $offers->setting_id = $request->user()->setting_id;
        $offers->save();

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
        $offer->fill($request->except('_method', '_token'));
        $offer->balance = BalanceHelper::calc($offer);
        $offer->save();
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
            $company->setting_id = $request->user()->setting_id;
            $offer->company_id = $company->id;
        } else {
            $company = null;
        }

        if ($request->get('client_id') > 0) {
            $client = Client::find($request->get('client_id'));
        } else if (!empty($request->get('client_name'))) {
            $client = Client::create(['name' => $request->get('client_name')]);
            $client->setting_id = $request->user()->setting_id;

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

//        $offer->balance = BalanceHelper::calc($offer);
        $offer->editor_id = Auth::user()->id;

        try {
            $offer->balance = BalanceHelper::calc($offer);
            $offer->save();
        } catch (\Exception $exception) {
            return ['status' => 'error', 'message' => 'Save error: ' . PHP_EOL . $exception->getMessage()];
        }

        if ($request->has('positions') && !empty($request->get('positions'))) {

            $positions = $request->get('positions');

            if (!empty($positions) && is_array($positions) && count($positions) > 0) {
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

        if ($offer->is_tender) {
            $result = $this->updateTender($offer);
            Log::info('Tender updated ' . $offer->version);
        } else {
            $result = $this->makeNewTender($offer, []);
            Log::info('Tender created ' . $offer->version);
        }


        return [
            'status' => 'success',
            'message' => 'Saved successfully',
            'offer' => $this->getData($offer->id),
            'tender' => $result
        ];
    }

    protected function updateTender(Offer $offer)
    {
        $tender = Tender::where([['offer_id', $offer->id], ['version', $offer->version]])->first();
        if (!$tender) {
            Log::info('Tender not found');
            return "Tender {$offer->id} - {$offer->version} not found";
        }
        $tender->profile_id = $offer->profile_id ?? null;
        $tender->materials = $offer->materials ?? null;
        $tender->colors = $offer->colors ?? null;
        $tender->squaring = $offer->squaring ?? null;
        $tender->meters = $offer->meters ?? null;
        $tender->delivery_address = $offer->delivery_address ?? null;
        $tender->total_with_vat = $offer->total_with_vat;
        $tender->cost = $offer->cost;
        $tender->expenses = $offer->expenses ?? null;
        $tender->comment = $offer->comment ?? null;
        $tender->total = $offer->total ?? null;
        $tender->save();

        $tender->positions()->detach();
        $tender->positions()->sync($offer->positions_ids);
        return 'updated';
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

    public function createOffer(Request $request)
    {
        $offer = Offer::whereNull('inquiry_date')->where('setting_id', $request->user()->setting_id)->get()->first();
        if (!$offer) {
            $offer = new Offer();
        }
        $offer->user_id = Auth::user()->id;
        $offer->created_at = date('Y-m-d H:i:s');
        $offer->setting_id = $request->user()->setting_id;
        $offer->number = $this->repo->getNewNumber($request);
//        $offer->number++;
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
        return Storage::disk('uploads')->exists('documents');
    }

    protected function updateOffer(Request $request)
    {
        $offer = Offer::findOrFail($request->get('id'));
        $offer->fill($request->except('client_id, manager_id, company_id, positions, file'));

        try {
            $offer->save();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }

        return ['status' => 'success'];
    }

    public function createTender($id)
    {
        $files = [];
        $offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $id)->get()->first();
        $offer->version = 1 + (int)Tender::where('offer_id', '=', $offer->id)->max('version');

        $positions = Position::where('offer_id', $id)->get();

        if (empty($positions)) {
            return ['status' => 'error', 'message' => 'Offer is empty'];
        }

//        $file = $this->createPdf($offer, $positions, 'Eng');
//        array_push($files, $file->id);
//
//        $file = $this->createPdf($offer, $positions, 'Lt');
//        array_push($files, $file->id);

        $offer->save();

        $this->makeVersion($offer->id, $files);

        return ['status' => 'success', 'file_name' => ''];
    }

    public function preview($id, $lang)
    {
        $tender = Tender::findOrFail($id);
        $offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $tender->offer_id)->get()->first();
        $offer->manager_id = $tender->manager_id;
        $offer->delivery_address = $tender->delivery_address;
        $offer->version = $tender->version;
        $offer->profile_id = $tender->profile_id;
        $offer->materials = $tender->materials;
        $offer->colors = $tender->colors;
        $offer->squaring = $tender->squaring;
        $offer->total = $tender->total;
        $offer->total_with_vat = $tender->total_with_vat;
        $offer->cost = $tender->cost;
        $offer->expenses = $tender->expenses;
        $offer->comment = $tender->comment;
        $positions = $tender->positions;



        if (empty($positions)) {
            return ['status' => 'error', 'message' => 'Offer is empty'];
        }

        return $this->getDocumentView($offer, $positions, $lang, 'documents.offer');
    }

    protected function getDocumentView($offer, $positions, $lang, $view){
        $setting = Setting::with('currency')->find($this->getSettingId());
        return view( $view. $lang, [
            'offer' => $offer,
            'positions' => $positions,
            'settings' => $setting,
            'fmt' => numfmt_create($setting->currency->locale, NumberFormatter::CURRENCY),
            'i' => 1,
            'button' => true
        ]);
    }

    public function tenderPrint($offer_id, $lang)
    {
        $offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $offer_id)->get()->first();
        $file = $this->createPdf($offer, $offer->positions, $lang);
        return Storage::disk('uploads')->download($file->file_uri);
    }

    public function contract($id, $lang)
    {
        $offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $id)->get()->first();
        $positions = $offer->positions;

        if (empty($positions)) {
            return ['status' => 'error', 'message' => 'Offer is empty'];
        }

        return $this->getDocumentView($offer, $positions, $lang, 'documents.contract');
    }

    public function contractPrint($offer_id, $lang)
    {
        $offer = Offer::with(['client', 'company', 'state', 'files', 'positions', 'manager'])->where('id', $offer_id)->get()->first();
        $file = $this->createPdf($offer, $offer->positions, $lang, 'contract');
        return Storage::disk('uploads')->download($file->file_uri);
    }

    /**
     * @param Offer $offer
     * @param $positions
     * @param string $lang
     * @param string $document
     * @return mixed
     */
    protected function createPdf(Offer $offer, $positions, string $lang, string $document = 'offer')
    {
        $fileName = $document .'_' . date('Ymd_His') . '_v' . $offer->version . '_' . $lang . '.pdf';
        $filePath = public_path('documents') . '/' . $fileName;

        $dompdf = App::make('dompdf.wrapper');
        $dompdf->setPaper('A4', 'portrait');

        $setting = Setting::with('currency')->find($this->getSettingId());

        $dompdf->loadView("documents.{$document}{$lang}", [
            'offer' => $offer,
            'positions' => $positions,
            'settings' => $setting,
            'fmt' => numfmt_create($setting->currency->locale, NumberFormatter::CURRENCY),
            'i' => 1,
            'button' => false,

        ])->save($filePath)->stream($fileName);

        return File::create([
            'file_name' => $fileName,
            'file_uri' => 'documents/' . $fileName
        ]);
    }
}
