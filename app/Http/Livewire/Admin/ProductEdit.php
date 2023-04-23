<?php

namespace App\Http\Livewire\Admin;

use App\Enums\CategoryType;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class ProductEdit extends Component
{

    public Product $product;
    public $categoryIds = [];
    public $images = [];
    public $categories;
    public $tabItem = 'info';
    public $title = 'Edit Product';

    protected function rules()
    {
        return [

            'product.title' => 'required',
            'product.slug' => 'required | unique:products,slug,' . $this->product->id,
            'product.featured_image' => 'required',
            'product.short_description' => 'required',
            'product.long_description' => 'required',
            'product.selling_price' => 'required|numeric|gt:0',
            'product.original_price' => 'required|numeric|gt:0',
            'product.images' => 'array',
            'product.images.*' => 'distinct|required|min:3',
        ];
    }

    public function render()
    {
        $categories = Category::where('type', CategoryType::productCategory)->get();
        $this->categories = $categories;
        return view('livewire.admin.product-edit');
    }
    public function mount(Product $product)
    {

        $this->product = $product;
        $this->categoryIds = $product->categories->pluck('id')->toArray();
        $this->images = $product->images;




    }

    public function update()
    {
        $this->product->images = $this->images;
        $this->validate();
        $this->product->save();
        $this->product->categories()->sync($this->categoryIds);


        return redirect(route('admin.products.index'));

    }
    public function setTab($item)
    {
        $this->tabItem = $item;
    }

    public function addNewImage()
    {

        $this->images = array_merge($this->images ?? [], [asset('images/logo.png')]);
    }
    public function removeImage($index)
    {
        unset($this->images[$index]);

    }
    public function removeDownloadable($index)
    {
        unset($this->downloadables[$index]);

    }

}