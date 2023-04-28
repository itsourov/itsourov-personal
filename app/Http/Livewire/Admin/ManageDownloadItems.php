<?php

namespace App\Http\Livewire\Admin;

use App\Enums\DownloadLinkType;
use Livewire\Component;
use App\Models\DownloadItem;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class ManageDownloadItems extends Component
{

    use WithPagination;
    public $product;
    public $showEditModal = false;
    public DownloadItem $editing;
    public $selectedDownloadItems = [];


    protected function rules()
    {
        return [

            'editing.title' => 'required',
            'editing.content' => 'required',
            'editing.size' => 'required',
            'editing.type' => ['required', Rule::in(DownloadLinkType::toArray())],


        ];
    }

    public function render()
    {
        $downloadItems = $this->product->downloadItems()->latest()->paginate(10);
        return view('livewire.admin.manage-download-items', [
            'downloadItems' => $downloadItems,
        ]);
    }
    public function mount()
    {
        $this->editing = new DownloadItem(['type' => DownloadLinkType::directLink]);
    }


    public function edit(DownloadItem $downloadItem)
    {
        if ($this->editing->isNot($downloadItem)) {
            $this->resetErrorBag();
            $this->editing = $downloadItem;
        }
        $this->showEditModal = true;
    }
    public function create()
    {

        if ($this->editing->getKey()) {
            $this->editing = new DownloadItem(['type' => '']);
            $this->resetErrorBag();
        }
        $this->showEditModal = true;
    }
    public function save()
    {
        $this->validate();
        $this->editing->downloadItemable()->associate($this->product);
        $this->editing->save();
        $this->showEditModal = false;
    }


    public function deleteSelected()
    {
        $selectedDownloadItems = $this->product->downloadItems()->whereKey($this->selectedDownloadItems);
        $selectedDownloadItems->delete();
        $this->selectedDownloadItems = [];
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            $csv = $this->product->downloadItems()->whereKey($this->selectedDownloadItems)->toCsv();
            echo $csv;
        }, 'download_items_for_product_' . $this->product->slug . '.csv');


    }
}