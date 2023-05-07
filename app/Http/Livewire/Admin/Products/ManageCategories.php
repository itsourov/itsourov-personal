<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductCategory;

class ManageCategories extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public ProductCategory $editing;
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
        $this->editing = new ProductCategory();
    }

    public function render()
    {
        return view('livewire.admin.products.manage-categories', [
            'categories' => ProductCategory::latest()->paginate(10)
        ]);
    }

    public function edit(ProductCategory $category)
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
            $this->editing = new ProductCategory();
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
        $selectedCategories = ProductCategory::whereKey($this->selectedCategories);
        $selectedCategories->delete();
        $this->selectedCategories = [];
    }
    public function exportSelected()
    {
        return response()->streamDownload(function () {
            $csv = ProductCategory::whereKey($this->selectedCategories)->toCsv();
            echo $csv;
        }, 'categories.csv');


    }
}