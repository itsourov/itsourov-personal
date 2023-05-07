<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{


    public function index()
    {


        return view('admin.google-drive.index');
    }

    public function redirect()
    {

        $client = new \Google\Client();
        $client->setClientId(config('services.google-admin.client_id'));
        $client->setClientSecret(config('services.google-admin.client_secret'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->addScope(\Google\Service\Drive::DRIVE);
        $client->setRedirectUri(route('admin.google-drive.callback'));

        return redirect($client->createAuthUrl());
    }

    public function callback(Request $request)
    {


        $client = new \Google\Client();
        $client->setClientId(config('services.google-admin.client_id'));
        $client->setClientSecret(config('services.google-admin.client_secret'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->addScope(\Google\Service\Drive::DRIVE);
        $client->setRedirectUri(route('admin.google-drive.callback'));

        if (request('error')) {
            return "there was an error";
        } else {
            $code = $client->fetchAccessTokenWithAuthCode(request('code'));
            $accessToken = $client->getAccessToken();
            $refreshToken = $client->getRefreshToken();

            return $code;
        }

    }
}