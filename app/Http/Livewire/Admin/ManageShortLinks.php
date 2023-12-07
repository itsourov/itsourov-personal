<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ShortLink;
use Livewire\WithPagination;

class ManageShortLinks extends Component
{

    use WithPagination;

    public $showEditModal = false;
    public ShortLink $editing;
    public $selectedShortLinks = [];
    public $selectAllInPage = false;


    protected function rules()
    {
        return [


            'editing.short_id' => 'required | unique:short_links,short_id,' . $this->editing->id,
            'editing.long_url' => 'required',


        ];
    }
    public function mount()
    {
        $this->editing = new ShortLink();
    }

    public function render()
    {
        return view('livewire.admin.manage-short-links', [
            'shortLinks' => ShortLink::latest()->paginate(10)
        ]);
    }


    public function edit(ShortLink $shortLink)
    {
        if ($this->editing->isNot($shortLink)) {
            $this->resetErrorBag();
            $this->editing = $shortLink;
        }
        $this->showEditModal = true;
    }
    public function create()
    {

        if ($this->editing->getKey()) {
            $this->editing = new ShortLink();
            $this->resetErrorBag();
        }
        $this->showEditModal = true;
    }
    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }
    public function deleteSelected()
    {
        $selectedShortLinks = ShortLink::whereKey($this->selectedShortLinks);
        $selectedShortLinks->delete();
        $this->selectedShortLinks = [];
    }
    public function exportSelected()
    {
        return response()->streamDownload(function () {
            $csv = ShortLink::whereKey($this->selectedShortLinks)->toCsv();
            echo $csv;
        }, 'shortLinks.csv');


    }



}
