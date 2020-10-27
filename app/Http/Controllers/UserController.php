<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Setting;
use App\Traits\SettingTrait;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use SettingTrait;

    protected $user;
    protected $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index()
    {
        $this->user = $this->repo->getCurrentUser();

        if ($this->user->hasRole('super-admin')) {
            $users = User::paginate(20);
        } else {
            $users = User::where('setting_id', '=', $this->user->setting_id)->paginate(20);
        }

        return view('user.index', ['users' => $users, 'user' => $this->user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('user.create',
            [
                'roles' => $this->repo->getRoles(),
                'settings' => $this->repo->getSettings(),
                'current_user' => $this->repo->getCurrentUser()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->except('_method', '_token'));
        $user->password = Hash::make($user->password);

        $user->save();
        if ($request->has('roles')) {
            $user->syncRoles($request->get('roles'));
        } else {
            $user->assignRole('user');
        }

        if ($request->has('setting_id') && !empty($request->get('setting_id'))) {
            $user->setting()->associate((int)$request->get('setting_id'));
        }

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('user.index', ['users' => User::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('user.create', [
            'user' => $user,
            'roles' => $this->repo->getRoles(),
            'settings' => $this->repo->getSettings(),
            'current_user' => $this->repo->getCurrentUser()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->has('password') && !empty($request->get('password'))) {
            $user->password = Hash::make($request->get('password'));
        }

        if ($request->has('roles')) {
            $user->syncRoles($request->get('roles'));
        }

        if ($request->has('setting_id') && !empty($request->get('setting_id'))) {
            $user->setting()->associate((int)$request->get('setting_id'));
        }

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }

        return redirect()->route('user.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = User::where('name', 'like', '%' . $string . '%')
            ->orWhere('email', 'like', '%' . $string . '%');

        if ($search !== false && !empty($search)) {
            return view('user.index', ['users' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
