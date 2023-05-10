<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MediaLibrary extends Component
{
    use WithFileUploads;
    use WithPagination;
    public bool $showFileUploadModal = false;
    public bool $showDetailsModal = false;
    public $uploadFile;
    public $previewFile;

    public function render()
    {
        $post = new Post();
        $post->id = 0;
        $post->exists = true;
        $images = $post->media()->where('collection_name', 'post-thumbnails')->paginate(4);
        return view('livewire.admin.media-library', compact('images'));
    }


    public function saveFileToDrive()
    {
        $post = new Post();
        $post->id = 0;
        $post->exists = true;
        $validatedImage = $this->validate([
            'uploadFile' => 'image|max:1500'
        ]);
        $post->addMedia($validatedImage['uploadFile'])
            ->withResponsiveImages()
            ->toMediaCollection('post-thumbnails', 'post-thumbnails');

        $this->uploadFile = null;
        $this->dispatchBrowserEvent('pondReset');
        $this->showFileUploadModal = false;

    }
    public function previewFile($index)
    {
        $post = new Post();
        $post->id = 0;
        $post->exists = true;

        $selectedMedia = $post->media()->findOrFail($index);
        $this->previewFile['name'] = $selectedMedia['file_name'];
        $this->previewFile['srcset'] = $selectedMedia->getSrcset();
        $this->previewFile['url'] = $selectedMedia->getUrl();
        $this->previewFile['size'] = $this->formatBytes($selectedMedia['size']);

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

}