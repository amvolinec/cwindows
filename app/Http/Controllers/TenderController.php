<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Position;
use App\Tender;
use App\Traits\TenderTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TenderController extends Controller
{
    use TenderTrait;
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
        $tender->delete();
        return redirect()->route('tender.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Tender::where('name', 'like', '%' . $string . '%')// ->orWhere('title', 'like', '%' . $string . '%')
        ;

        if ($search !== false && !empty($search)) {
            return view('tender.index', ['tenders' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
