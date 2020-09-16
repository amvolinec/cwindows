<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceStoreRequest;
use App\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $services = Service::paginate(20);
        return view('service.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('service.create', [
            'states' => Service::states(),
            'payers' => Service::payers(),
            'offers' => \App\Offer::all(),
            'managers' => \App\User::role('manager')->get(),
            'clients' => \App\Client::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ServiceStoreRequest $request)
    {

        $service = Service::create($request->except('_method', '_token', 'warranty'));
        $service->warranty = $request->has('warranty') ? 1 : 0;
        $service->user_id = Auth::user()->id;
        $service->save();

        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('service.index', ['services' => Service::where('id', $id)->paginate(), 'offers' => \App\Offer::all(), 'managers' => \App\User::role('manager')->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return View
     */
    public function edit(Service $service)
    {
        return view('service.create', [
            'states' => Service::states(),
            'payers' => Service::payers(),
            'service' => $service,
            'offers' => \App\Offer::all(),
            'managers' => \App\User::role('manager')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceStoreRequest $request
     * @param Service $service
     * @return RedirectResponse
     */
    public function update(ServiceStoreRequest $request, Service $service)
    {
        $service->fill($request->except('_method', '_token', 'warranty'))->save();
        $service->warranty = $request->has('warranty') ? 1 : 0;
        $service->save();

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return RedirectResponse
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Service::where('completed_at', 'like', '%' . $string . '%')// ->orWhere('title', 'like', '%' . $string . '%')
        ;

        if ($search !== false && !empty($search)) {
            return view('service.index', ['services' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
