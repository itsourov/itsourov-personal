<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class GoogleDriveExplorer extends Component
{
    protected $service;
    public $message = '';
    public $data = [];
    public $nextPageToken;
    public $hasMorePage = false;

    public $tokenExpired = false;


    public $files = [];
    public $currentFolderId;
    public $currentPath = [
        [
            'name' => "Home",
        ]

    ];
    public $editingFile;
    public $showDetailsModal = false;



    public function render()
    {




        return view('livewire.admin.google-drive-explorer', [
            'data' => $this->data,
            'tokenExpired' => $this->tokenExpired,

        ]);
    }
    public function initGoogleDrive()
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


        // Set up the Drive API service
        $this->service = new \Google_Service_Drive($client);

        $about = $this->service->about->get(array('fields' => 'user'))->getUser();

        $this->data['name'] = $about->displayName;
        $this->data['email'] = $about->emailAddress;
        $this->data['permissionId'] = $about->permissionId;
        $this->data['photoLink'] = $about->photoLink;

        // Get the root folder ID
        $rootFolder = $this->service->files->get('root');
        return $rootFolder->getId();

    }
    public function mount()
    {
        $this->currentFolderId = $this->initGoogleDrive();
        $this->loadGoogleClient();
    }
    public function loadGoogleClient()
    {





        // Retrieve a list of files and folders from the home directory
        $files = $this->service->files->listFiles(
            array(
                'pageToken' => $this->nextPageToken,
                'q' => "'$this->currentFolderId' in parents and trashed = false",
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

    }
    public function loadMore()
    {
        $this->currentFolderId = $this->initGoogleDrive();
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

        $this->editingFile = $this->files[$index];
        if ($this->editingFile['mimeType'] == 'application/vnd.google-apps.folder') {
            $this->files = [];
            $this->initGoogleDrive();
            $this->currentFolderId = $this->editingFile['id'];
            $this->nextPageToken = null;
            $this->loadGoogleClient();

            array_push($this->currentPath, [
                'id' => $this->editingFile['id'],
                'name' => $this->editingFile['name'],
            ]);

        } else {

            dd("its not an folder");
        }

    }
    public function previewFile($index)
    {

        $this->editingFile = $this->files[$index];
        $this->showDetailsModal = true;



    }
    public function openFromPath($id, $index)
    {

        $this->files = [];
        if (!$id) {
            $this->currentFolderId = $this->initGoogleDrive();
        } else {
            $this->initGoogleDrive();
            $this->currentFolderId = $id;
        }
        $this->nextPageToken = null;
        $this->loadGoogleClient();


        $this->currentPath = $this->keep_items_before_index($this->currentPath, $index + 1);

    }
    public function update()
    {
        $this->initGoogleDrive();
        // Define the file ID and new name
        $fileId = $this->editingFile['id'];
        $newName = $this->editingFile['name'];

        // Retrieve the existing file metadata
        $file = $this->service->files->get($fileId);

        // Update the name
        $file->setName($newName);

        // Update the file metadata in Drive
        $updatedFile = $this->service->files->update(
            $fileId,
            $file,
            array(
                'fields' => 'name'
            )
        );
        dd($updatedFile);
    }
    function keep_items_before_index($array, $index)
    {
        return array_slice($array, 0, $index);
    }
}