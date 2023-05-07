<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function googleCallback()
    {


        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();
            if (!$user) {

                $new_user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'token' => $googleUser->token,
                    'role' => $googleUser->getEmail() == 'sourovbuzz@gmail.com' ? UserRole::admin : UserRole::user,
                ]);

                Auth::login($new_user);
                if ($googleUser['verified_email']) {
                    $new_user->markEmailAsVerified();
                }
                event(new Registered($new_user));
                $new_user->addMediaFromUrl(str_replace('=s96-c', '', $googleUser->avatar))
                    ->usingFileName($googleUser->name . '.png')
                    ->toMediaCollection('profile-images', 'profile-images');

                return redirect()->intended(RouteServiceProvider::HOME)->withNotification('You are now logged in!');
            } else {
                Auth::login($user);
                $user->update(['token' => $googleUser->token]);
                if ($googleUser['verified_email']) {
                    $user->markEmailAsVerified();
                }

                return redirect()->intended(RouteServiceProvider::HOME)->withNotification('You are now logged in!');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}