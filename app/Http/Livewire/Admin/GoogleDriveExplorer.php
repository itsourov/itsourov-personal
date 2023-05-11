<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;


class GoogleDriveExplorer extends Component
{
    use WithFileUploads;

    private $service;

    public $data;
    public $files = [];
    public ?string $currentFolderId;
    public ?string $nextPageToken;
    public $currentPath = [
        [
            'name' => "Home",
        ]

    ];


    public $unAuthorized = false;
    public $hasMorePage = false;
    public $showDetailsModal = false;
    public $showEditModal = false;
    public $showFileUploadModal = false;
    public $showAddFolderModal = false;


    public $editingFile;
    public $newFolder;
    public $uploadFile;


    public function render()
    {


        return view('livewire.admin.google-drive-explorer', [
            'data' => $this->data

        ]);
    }

    public function mount()
    {

        $this->nextPageToken = null;

        $this->initGoogleDrive();
        $this->getUserData();
        $this->currentFolderId = $this->getRootFolderId();
        $this->loadGoogleClient();
    }

    public function initGoogleDrive()
    {
        $client = new \Google\Client();
        $client->setClientId(config('services.google-admin.client_id'));
        $client->setClientSecret(config('services.google-admin.client_secret'));
        $client->refreshToken(config('services.google-admin.refresh_token'));

        // Set up the Drive API service
        $this->service = new \Google_Service_Drive($client);


    }
    public function getUserData()
    {

        $about = $this->service->about->get(array('fields' => 'user'))->getUser();

        $this->data['name'] = $about->displayName;
        $this->data['email'] = $about->emailAddress;
        $this->data['permissionId'] = $about->permissionId;
        $this->data['photoLink'] = $about->photoLink;


    }
    public function getRootFolderId()
    {
        // Get the root folder ID
        $rootFolder = $this->service->files->get('root');
        return $rootFolder->getId();
    }

    public function loadGoogleClient()
    {





        // Retrieve a list of files and folders from the home directory
        $files = $this->service->files->listFiles(
            array(
                'orderBy' => 'name',
                'pageToken' => $this->nextPageToken,
                'q' => "'$this->currentFolderId' in parents and trashed = false",
                'pageSize' => 20,
                'fields' => 'nextPageToken, files(id, name, mimeType, iconLink, size, thumbnailLink)',
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
                'thumbnailLink' => $file->getThumbnailLink(),
            ]);
        }
        // dd($this->files);

    }

    public function loadMore()
    {
        $this->initGoogleDrive();

        $this->loadGoogleClient();
    }

    public function openFolder($index)
    {
        $selectedFolder = $this->files[$index];
        if ($selectedFolder['mimeType'] == 'application/vnd.google-apps.folder') {
            $this->files = [];
            $this->initGoogleDrive();
            $this->currentFolderId = $selectedFolder['id'];
            $this->nextPageToken = null;
            $this->loadGoogleClient();

            array_push($this->currentPath, [
                'id' => $selectedFolder['id'],
                'name' => $selectedFolder['name'],
            ]);

        } else {

            dd("its not an folder");
        }

    }

    public function openFromPath($id, $index)
    {
        $this->initGoogleDrive();
        $this->files = [];
        if (!$id) {
            $this->currentFolderId = $this->getRootFolderId();
        } else {

            $this->currentFolderId = $id;
        }
        $this->nextPageToken = null;
        $this->loadGoogleClient();


        $this->currentPath = $this->keep_items_before_index($this->currentPath, $index + 1);

    }
    public function showEditModal($index)
    {
        $this->editingFile = $this->files[$index];
        $this->showEditModal = true;

    }
    public function update()
    {
        $this->initGoogleDrive();

        // Define the file ID and new name
        $fileId = $this->editingFile['id'];
        $newName = $this->editingFile['name'];


        $emptyFile = new \Google_Service_Drive_DriveFile();

        // Update the name
        $emptyFile->setName($newName);



        // Update the file metadata in Drive
        $updatedFile = $this->service->files->update(
            $fileId,
            $emptyFile,
            array(
                'fields' => 'name'
            )
        );
        $this->showEditModal = false;
        $this->files = [];
        $this->nextPageToken = null;
        $this->loadGoogleClient();
    }


    public function makeFolder()
    {
        $this->initGoogleDrive();


        // Create a new folder object
        $folder = new \Google\Service\Drive\DriveFile();
        $folder->setName($this->newFolder['name']);
        $folder->setMimeType('application/vnd.google-apps.folder');
        $folder->setParents([$this->currentFolderId]);


        $newCreatedFolder = $this->service->files->create($folder);
        $this->newFolder = null;
        $this->showAddFolderModal = false;
        $this->nextPageToken = null;
        $this->files = [];
        $this->loadGoogleClient();
    }

    public function saveFileToDrive()
    {

        $validateUploadFile = $this->validate([
            'uploadFile' => 'file|max:15000'
        ]);
        $file = $validateUploadFile['uploadFile'];
        $name = $file->getClientOriginalName();
        $mimeType = $file->getClientMimeType();
        $this->initGoogleDrive();

        $fileMetadata = new \Google\Service\Drive\DriveFile(
            array(
                'name' => $name,
                'parents' => [$this->currentFolderId],
            )
        );


        $uploadedFile = $this->service->files->create(
            $fileMetadata,
            array(
                'data' => file_get_contents($file->getRealPath()),
                'mimeType' => $mimeType,
                'uploadType' => 'multipart',
                'fields' => 'id,parents',
            )
        );
        $this->uploadFile = null;
        $this->dispatchBrowserEvent('pondReset');
        $this->showFileUploadModal = false;
        $this->files = [];
        $this->nextPageToken = null;
        $this->loadGoogleClient();
    }

    public function previewFile($index)
    {

        $this->editingFile = $this->files[$index];
        $this->showDetailsModal = true;



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
    function keep_items_before_index($array, $index)
    {
        return array_slice($array, 0, $index);
    }


}