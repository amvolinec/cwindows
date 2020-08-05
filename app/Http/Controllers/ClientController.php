<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $clients = Client::all();
        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Client::create($request->except('_method', '_token'));
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Client  $client
     * @return RedirectResponse
     */
    public function show(Client $client)
    {
        return redirect()->route('client.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client  $client
     * @return View
     */
    public function edit(Client $client)
    {
        return view ('client.create' , ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Client  $client
     * @return RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        $client->fill($request->except('_method', '_token'))->save();
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return RedirectResponse
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index');
    }
}
