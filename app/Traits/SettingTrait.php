<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth;

trait SettingTrait
{
    public function getSettingId()
    {
        $auth_user = Auth::user();
        if(is_object($auth_user)){
            $user_id = $auth_user->id;
            $user = User::findOrFail($user_id);
            return $user->setting->id;
        } else {
            return null;
        }
    }
}
