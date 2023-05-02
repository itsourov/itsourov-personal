<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{


    public function index()
    {


        return view('admin/google-drive.index');
    }

    public function redirect()
    {

        $client = new \Google\Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->addScope(\Google\Service\Drive::DRIVE);
        $client->setRedirectUri(route('admin.google-drive.callback'));

        return redirect($client->createAuthUrl());
    }

    public function callback(Request $request)
    {

        $client = new \Google\Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->addScope(\Google\Service\Drive::DRIVE);
        $client->setRedirectUri(route('admin.google-drive.callback'));

        if (request('error')) {
            return "there was an error";
        } else {
            $client->fetchAccessTokenWithAuthCode(request('code'));
            $accessToken = $client->getAccessToken();
            $refreshToken = $client->getRefreshToken();

            // Save the access token and refresh token to your database.

            auth()->user()->update([
                'refresh_token' => $refreshToken,
                'access_token' => $accessToken,
            ]);

            return redirect(route('admin.google-drive.index'))->with('message', "Authenticated! token was saved to database");

        }

    }
}