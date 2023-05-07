<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\PostCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ManageCategories extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public PostCategory $editing;
    public $selectedCategories = [];
    public $selectAllInPage = false;






    protected function rules()
    {
        return [

            'editing.title' => 'required',
            'editing.slug' => 'required | unique:post_categories,slug,' . $this->editing->id,



        ];
    }
    public function mount()
    {
        $this->editing = new PostCategory();
    }

    public function render()
    {
        return view('livewire.admin.posts.manage-categories', [
            'categories' => PostCategory::latest()->paginate(10)
        ]);
    }

    public function edit(PostCategory $category)
    {
        if ($this->editing->isNot($category)) {
            $this->resetErrorBag();
            $this->editing = $category;
        }
        $this->showEditModal = true;
    }
    public function create()
    {

        if ($this->editing->getKey()) {
            $this->editing = new PostCategory();
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
        $selectedCategories = PostCategory::whereKey($this->selectedCategories);
        $selectedCategories->delete();
        $this->selectedCategories = [];
    }
    public function exportSelected()
    {
        return response()->streamDownload(function () {
            $csv = PostCategory::whereKey($this->selectedCategories)->toCsv();
            echo $csv;
        }, 'categories.csv');


    }
}