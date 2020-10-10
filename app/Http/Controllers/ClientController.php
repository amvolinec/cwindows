<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\Http\Requests\ClientRequest;
use App\Traits\SettingTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    use SettingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $clients = Client::with('company', 'offers')->get();
        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('client.create', ['companies' => Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $client = Client::create($request->except('_method', '_token'));
        $client->setting_id = $this->getSettingId();
        $client->save();

        return redirect()->route('client.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        $clients = Client::where('id', $id)->get();
        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client  $client
     * @return View
     */
    public function edit(Client $client)
    {
        return view ('client.create' , ['client' => $client, 'companies' => Company::all()]);
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

    public function getContact(Request $request){
        if($request->has('name')) {
            $where = array();
            array_push($where, ['name', 'like', '%' . $request->get('name') . '%']);
            if($request->has('companyId') && $request->get('companyId') > 0){
                array_push($where, ['company_id', '=', $request->get('companyId')]);
            }
            $companies = Client::where($where)->get();
        } else {
            $companies = [];
        }
        return $companies;
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ? $search : $request->get('string');

        $data = Client::where('name', 'like', '%' . $string . '%')
            ->orWhere('email', 'like', '%' . $string . '%')
            ->orWhere('phone', 'like', '%' . $string . '%')
            ->take(10)->get();

        if ($search !== false && !empty($search)) {
            return view('client.index', ['clients' => $data, 'search' => $string]);
        } else {
            return $data;
        }
    }

    public function add(ClientRequest $request)
    {
        $client = Client::create($request->all());
        return $client->id;
    }

}
