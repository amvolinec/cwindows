<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function getCurrentUser()
    {
        if (Auth::check()) {
            return User::findOrFail(Auth::id());
        }
    }

    public function getSettings()
    {
        $user = $this->getCurrentUser();
        if ($user->hasRole('super-admin')) {
            return Setting::all();
        } else {
            return Setting::find($user->setting_id);
        }
    }

    public function getRoles()
    {
        $user = $this->getCurrentUser();
        if ($user->hasRole('super-admin')) {
            return Role::all();
        } else {
            return Role::where('name', '<>', 'super-admin')->get();
        }
    }
}
