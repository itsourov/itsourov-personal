<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function facebookCallback()
    {


        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $img = $facebookUser->avatar_original . "&access_token={$facebookUser->token}";

            $user = User::where('email', $facebookUser->getEmail())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'role' => $facebookUser->getEmail() == 'sourovbuzz@gmail.com' ? 'admin' : 'user',
                ]);

                Auth::login($new_user);
                $new_user->markEmailAsVerified();
                event(new Registered($new_user));
                // $new_user->addMediaFromUrl($img)
                //     ->usingFileName($facebookUser->name . '.png')
                //     ->toMediaCollection('profile-images', 'profile-images');

                return redirect()->intended(RouteServiceProvider::HOME)->withNotification('You are now logged in!');
            } else {
                Auth::login($user);
                $user->markEmailAsVerified();

                return redirect()->intended(RouteServiceProvider::HOME)->withNotification('You are now logged in!');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}