<?php

namespace App\Http\Controllers;


use App\Contract;
use App\Offer;
use App\Period;
use App\Traits\ContractTrait;
use App\Transaction;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    use ContractTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('contract.index', ['contracts' => Contract::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('contract.create', ['contracts' => Contract::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Contract::create($request->all());

        return redirect()->route('contract.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Contract $contract)
    {
        return view('contract.show', ['contract' => $contract]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Contract $contract)
    {
        return view ('contract.edit', ['contract' => $contract]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contract $contract)
    {
        $contract->fill($request->all())->save();

        if($request->ajax()){
            return ['status' => 'success'];
        } else {
            return redirect()->route('contract.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contract.index');
    }

    public function createContract(Request $request){
        $offer_id = $request->get('offer_id');
        return $this->makeNewContract($offer_id);
    }

    public function get($id){
        $offer = Offer::findOrFail($id);
        $data = [
            'contract' => Contract::with('period', 'client', 'company', 'manager', 'offer', 'production_number')->where('offer_id', $id)->first(),
            'payments' => $offer->payments,
            'costs' => $offer->costs,
            'periods' => Period::all(),
            ];
        return $data;
    }
}
