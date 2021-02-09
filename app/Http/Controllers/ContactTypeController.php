<?php

namespace App\Http\Controllers;

use App\ContactType;
use Illuminate\Http\Request;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacttype.index', ['contactTypes' => ContactType::with('contacts')->paginate(20)]);
    }

    /**s
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('contacttype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ContactType::create($request->all());

        return redirect()->route('contact_type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ContactType $contactType
     * @return \Illuminate\Http\Response
     */
    public function show(ContactType $contactType)
    {
        return view('contacttype.index', ['contactType' => $contactType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ContactType $conractType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactType $contactType)
    {
        return view('contacttype.create', ['contact_types' => $contactType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ContactType $conractType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactType $contactType)
    {
        $contactType->fill($request->all())->save();

        {
            return redirect()->route('contact_type.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ContactType $contactType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactType $contactType)
    {
        $contactType->delete();
        return redirect()->route('contact_type.index');
    }


//    public function find(Request $request, $search = false)
//    {
//        list($query, $bindings) = $this->getQuery($request, $search, 'name,phone,address,email', false);
//
//        if ($search !== false && !empty($search)) {
//
//            $contactTypes = ContactType::with('firm')->whereRaw($query, $bindings)->paginate(20);
//            return view('contacttype.index', ['contacts' => $contactTypes, 'search' => $request->get('string')]);
//
//        } else {
//
//            return DB::table("contact_types")->whereRaw($query, $bindings)->take(10)->get();
//
//        }
//    }




}
