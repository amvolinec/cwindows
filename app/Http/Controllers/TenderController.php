<?php

namespace App\Http\Controllers;

use App\File;
use App\Offer;
use App\Position;
use App\Tender;
use App\Traits\OfferTrait;
use App\Traits\TenderTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TenderController extends Controller
{
    use TenderTrait;
    use OfferTrait;

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $tenders = Tender::paginate(20);
        return view('tender.index', ['tenders' => $tenders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('tender.create', ['managers' => \App\User::all(), 'profiles' => \App\Profile::all(), 'offers' => \App\Offer::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Tender::create($request->except('_method', '_token'));
        return redirect()->route('tender.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('tender.index', ['tenders' => Tender::where('id', $id)->paginate(), 'managers' => \App\User::all(), 'profiles' => \App\Profile::all(), 'offers' => \App\Offer::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tender $tender
     * @return View
     */
    public function edit(Tender $tender)
    {
        return view('tender.create', ['tender' => $tender, 'managers' => \App\User::all(), 'profiles' => \App\Profile::all(), 'offers' => \App\Offer::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tender $tender
     * @return RedirectResponse
     */
    public function update(Request $request, Tender $tender)
    {
        $tender->fill($request->except('_method', '_token'))->save();
        return redirect()->route('tender.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tender $tender
     * @return RedirectResponse
     */
    public function destroy(Tender $tender)
    {
//        $tender->positions()->detach();
        $tender->delete();
        return redirect()->route('tender.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');
        $data = Tender::where('name', 'like', '%' . $string . '%');

        if ($search !== false && !empty($search)) {
            return view('tender.index', ['tenders' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }

    public function set($id)
    {
        return $this->setVersion($id);
    }

    public function deleteTender(Request $request)
    {
        Tender::findOrFail($request->get('tender_id'))->delete();
        return $request->get('tender_id');
    }

    public function setTender(Request $request, $id){
        $offer = Offer::with('positions', 'files')->findOrFail($request->get('id'));
        $offer->fill($request->except('client_id, manager_id, company_id, positions'));
        $offer->save();

        return $offer;
    }

    public function getFiles(Request $request): array
    {
        $tender = Tender::with('files')->where([['offer_id', $request->get('offer_id')],['version', $request->get('version')]])->first();
        return ['files' => $tender->files];
    }

    public function setFile(Request $request){
        $path = '';

        if ($request->hasFile('file')) {

            $file_name = $request->file('file')->getClientOriginalName();
            $tender = Tender::with('files')->where([['offer_id', $request->get('offer_id')],['version', $request->get('version')]])->first();

            try {
                $path = Storage::disk('uploads')->putFile('documents', $request->file('file'));
            } catch (\Exception $exception) {
                return ['status' => 'error', 'message' => 'File save error: ' . PHP_EOL . $exception->getMessage()];
            }

            $file = File::create([
                'file_name' => $file_name,
                'file_uri' => $path,
            ]);

            $tender->files()->attach($file->id);
        }

        return $path;
    }
}
