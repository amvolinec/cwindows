<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Person[]|\Illuminate\Database\Eloquent\Collection|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Person::orderBy('id', 'desc')->paginate(10);
        } else {
            $persons = Person::paginate(10);
            return view('person.index', ['persons' => $persons]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('person.create', ['company' => \App\Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Person::create($request->except('_method', '_token'));
        return redirect()->route('person.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('person.index', ['persons' => Person::where('id', $id)->paginate(), 'company' => \App\Company::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @return View
     */
    public function edit(Person $person)
    {
        return view('person.create', ['person' => $person, 'company' => \App\Company::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Person $person
     * @return RedirectResponse
     */
    public function update(Request $request, Person $person)
    {
        $person->fill($request->except('_method', '_token'))->save();
        return redirect()->route('person.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $person
     * @return RedirectResponse
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('person.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Person::where('name', 'like', '%' . $string . '%')// ->orWhere('title', 'like', '%' . $string . '%')
        ;

        if ($search !== false && !empty($search)) {
            return view('person.index', ['persons' => $data->paginate(10), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }

    public function multiStore(Request $request)
    {
        $data = $request->get('data');

        foreach ($data as $row) {
            try {
                $person = Person::find($row['id']);
                if(isset($row['deleted']) && $row['deleted'] === true){
//                    Log::info('Deleted ' . $row['id']);
                    $person->delete();
                } else {
                    unset($row['id']);
                    $person->fill($row);
                    $person->save();
                }
            } catch (\Exception $exception) {
                Log::error('Error: ' . $exception->getMessage());
                return false;
            }
        }
        return 'Success';
    }

    public function add() {
        Person::create(['name' => 'Undefined']);
        return Person::orderBy('id', 'desc')->paginate(10);
    }
}
