<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class GoogleDriveExplorer extends Component
{
    public $data = [];
    public $tokenExpired = false;

    public bool $loadData = false;

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {



        if ($this->loadData)
            $this->mounts();
        return view('livewire.admin.google-drive-explorer', [
            'data' => $this->data,
            'tokenExpired' => $this->tokenExpired,

        ]);
    }
    public function mounts()
    {

        $client = new \Google\Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        try {
            $client->setAccessToken(auth()->user()->access_token);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

        $this->tokenExpired = $client->isAccessTokenExpired();

        if (!$client->isAccessTokenExpired()) {

            // Set up the Drive API service
            $service = new \Google_Service_Drive($client);

            $about = $service->about->get(array('fields' => 'user'))->getUser();
            $this->data['name'] = $about->displayName;
            $this->data['emailAddress'] = $about->emailAddress;
            $this->data['permissionId'] = $about->permissionId;
            $this->data['photoLink'] = $about->photoLink;
        }





    }


}