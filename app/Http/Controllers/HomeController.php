<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View|RedirectResponse
     */
    public function index()
    {
        $this->user = Auth::check() ? Auth::user() : false;
        if($this->user->hasRole('super-admin')) {
            return redirect()->route('forms.index');
        } else {
            return view('home');
        }

    }
}
