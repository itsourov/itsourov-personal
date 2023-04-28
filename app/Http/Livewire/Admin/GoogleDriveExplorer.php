<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class GoogleDriveExplorer extends Component
{
    public $message = '';
    public $data = [];
    public $nextPageToken;
    public $hasMorePage = false;

    public $tokenExpired = false;

    public bool $loadData = false;
    public $files = [];
    public $showDetailsModal = false;

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {



        if ($this->loadData)
            $this->loadGoogleClient();
        return view('livewire.admin.google-drive-explorer', [
            'data' => $this->data,
            'tokenExpired' => $this->tokenExpired,

        ]);
    }
    public function loadGoogleClient()
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

        // if (!$client->isAccessTokenExpired()) {
        try {

            // Set up the Drive API service
            $service = new \Google_Service_Drive($client);

            $about = $service->about->get(array('fields' => 'user'))->getUser();

            $this->data['name'] = $about->displayName;
            $this->data['email'] = $about->emailAddress;
            $this->data['permissionId'] = $about->permissionId;
            $this->data['photoLink'] = $about->photoLink;

            // Get the root folder ID
            $rootFolder = $service->files->get('root');
            $rootFolderId = $rootFolder->getId();

            // Retrieve a list of files and folders from the home directory
            $files = $service->files->listFiles(
                array(
                    'pageToken' => $this->nextPageToken,
                    'q' => "'$rootFolderId' in parents and trashed = false",
                    'pageSize' => 20,
                    'fields' => 'nextPageToken, files(id, name, mimeType, iconLink, size)',
                )
            );

            $this->nextPageToken = $files->getNextPageToken();
            if (!$this->nextPageToken) {
                $this->hasMorePage = false;
            } else {
                $this->hasMorePage = true;
            }

            // dump($files->getFiles());
            foreach ($files->getFiles() as $file) {
                array_push($this->files, [
                    'name' => $file->getName(),
                    'id' => $file->getId(),
                    'mimeType' => $file->getMimeType(),
                    'iconLink' => $file->getIconLink(),
                    'size' => $this->formatBytes($file->getSize()),
                ]);
            }

        } catch (\Throwable $th) {
            $this->message = $th->getMessage();
        }


        // }

    }
    public function loadMore()
    {
        $this->loadGoogleClient();
    }

    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
    public function open($index)
    {
        // $this->message = $this->files[$index];
        $this->showDetailsModal = true;
    }

}