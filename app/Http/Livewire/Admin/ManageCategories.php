<?php

namespace App\Http\Livewire\Admin;

use App\Enums\CategoryType;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class ManageCategories extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public Category $editing;





    protected function rules()
    {
        return [

            'editing.title' => 'required',
            'editing.slug' => 'required | unique:categories,slug,' . $this->editing->id,
            'editing.type' => ['required', Rule::in(CategoryType::toArray())],


        ];
    }
    public function mount()
    {
        $this->editing = new Category(['type' => '']);
    }

    public function render()
    {
        return view('livewire.admin.manage-categories', [
            'categories' => Category::latest()->paginate(10)
        ]);
    }

    public function edit(Category $category)
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
            $this->editing = new Category(['type' => '']);
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
}