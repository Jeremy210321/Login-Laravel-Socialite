<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class loginController extends Controller
{
    public function redirectToProviderGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleProviderCallBackGithub()
    {
        $userGithub = Socialite::driver('github')->user();
        // dd($userGithub);
        $userExist = User::where('external_id', $userGithub->id)->where('external_auth', 'github')->first();
        if ($userExist) {
            Auth::login($userGithub);
        } else {
            $userLog = User::create([
                'name' => $userGithub->nickname,
                'email' => $userGithub->email,
                'avatar' => $userGithub->avatar,
                'external_id' => $userGithub->id,
                'external_auth' => 'github',

            ]);
            Auth::login($userLog);
        }
        return redirect('dashboard');
    }
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallBackGoogle()
    {
        $userGoogle = Socialite::driver('google')->user();
        // dd($userGoogle);
        $userExist = User::where('external_id', $userGoogle->id)->where('external_auth', 'google')->first();
        if ($userExist) {
            Auth::login($userGoogle);
        } else {
            $userLog = User::create([
                'name' => $userGoogle->name,
                'email' => $userGoogle->email,
                'avatar' => $userGoogle->avatar,
                'external_id' => $userGoogle->id,
                'external_auth' => 'google',

            ]);
            Auth::login($userLog);
        }
        return redirect('dashboard');
    }
}
