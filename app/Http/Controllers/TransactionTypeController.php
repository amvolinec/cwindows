<?php

namespace App\Http\Controllers;

use App\TransactionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $transaction_types = TransactionType::paginate(20);
        return view('transactiontype.index', ['transaction_types' => $transaction_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('transactiontype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        TransactionType::create($request->except('_method', '_token'));
        return redirect()->route('transactiontype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('transactiontype.index', ['transaction_types' => TransactionType::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TransactionType  $transactiontype
     * @return View
     */
    public function edit(TransactionType $transactiontype)
    {
        return view ('transactiontype.create' , ['transactiontype' => $transactiontype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  TransactionType  $transactiontype
     * @return RedirectResponse
     */
    public function update(Request $request, TransactionType $transactiontype)
    {
        $transactiontype->fill($request->except('_method', '_token'))->save();
        return redirect()->route('transactiontype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TransactionType  $transactiontype
     * @return RedirectResponse
     */
    public function destroy(TransactionType $transactiontype)
    {
        $transactiontype->delete();
        return redirect()->route('transactiontype.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = TransactionType::where('name', 'like', '%' . $string . '%')
             ->orWhere('info', 'like', '%' . $string . '%');

        if ($search !== false && !empty($search)) {
            return view('transactiontype.index', ['transaction_types' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
