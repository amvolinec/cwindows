<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $transactions = Transaction::paginate(20);
        return view('transaction.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('transaction.create',[
            'transaction_types' => \App\TransactionType::all(),
            'offers' => Offer::all(),
            'states' => Transaction::states()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Transaction::create($request->except('_method', '_token'));
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('transaction.index', [
            'transactions' => Transaction::where('id', $id)->paginate(),
            'transaction_types' => \App\TransactionType::all(),
            'offers' => Offer::all(),
            'states' => Transaction::states()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Transaction  $transaction
     * @return View
     */
    public function edit(Transaction $transaction)
    {
        return view ('transaction.create' , [
            'transaction' => $transaction,
            'transaction_types' => \App\TransactionType::all(),
            'offers' => Offer::all(),
            'states' => Transaction::states()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Transaction  $transaction
     * @return RedirectResponse
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->fill($request->except('_method', '_token'))->save();
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transaction  $transaction
     * @return RedirectResponse
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Transaction::where('number', 'like', '%' . $string . '%')
             ->orWhere('info', 'like', '%' . $string . '%');

        if ($search !== false && !empty($search)) {
            return view('transaction.index', ['transactions' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
