<?php

namespace App\Http\Controllers;

use App\Contact;

use App\Firm;
use App\Http\Requests\ContactRequest;
use App\Traits\SearchTrait;
use App\Traits\SettingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    use SettingTrait;
    use SearchTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index', ['contacts' => Contact::with('firm')->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('contact.create',
            [
                'firms' => Firm::all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->all());

        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contact.show', ['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contact.create', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->fill($request->all())->save();

        {
            return redirect()->route('contact.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contact.index');
    }

    public function find(Request $request, $search = false)
    {
        list($query, $bindings) = $this->getQuery($request, $search, 'name,phone,address,email', false);

        if ($search !== false && !empty($search)) {

            $contacts = Contact::with('firm')->whereRaw($query, $bindings)->paginate(20);
            return view('contact.index', ['contacts' => $contacts, 'search' => $request->get('string')]);

        } else {

            return DB::table("contacts")->whereRaw($query, $bindings)->take(10)->get();

        }
    }



}
