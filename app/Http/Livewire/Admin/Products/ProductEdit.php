<?php

namespace App\Http\Livewire\Admin\Products;


use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Enums\CategoryType;
use Livewire\WithFileUploads;
use App\Models\ProductCategory;


class ProductEdit extends Component
{
    use WithFileUploads;
    public Product $product;
    public $title = 'Edit Product';
    public $featuredImage;
    public $productImages = [];
    public $selectedCategories = [];


    protected function rules()
    {
        return [

            'product.title' => 'required',
            'product.slug' => 'required | unique:products,slug,' . $this->product->id,
            'product.short_description' => 'required',
            'product.long_description' => 'required',
            'product.selling_price' => 'required|numeric|gt:0',
            'product.original_price' => 'required|numeric|gt:0',
            'featuredImage' => 'nullable|image|max:1500',
            'productImages.*' => 'nullable|image|max:1500',
            'selectedCategories' => ''


        ];
    }

    public function render()
    {
        $categories = ProductCategory::get();
        return view('livewire.admin.products.product-edit', [
            'categories' => $categories,
        ]);
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->selectedCategories = $product->categories->pluck('id')->toArray();
    }

    public function update()
    {


        $this->validate();

        $this->product->save();
        $this->product->categories()->sync($this->selectedCategories);

        if ($this->featuredImage) {

            $this->product->clearMediaCollection('product-thumbnails');
            $this->product->addMedia($this->featuredImage)
                ->withResponsiveImages()
                ->toMediaCollection('product-thumbnails', 'product-thumbnails');

        }
        if ($this->productImages) {


            foreach ($this->productImages as $productImage) {
                $this->product->addMedia($productImage)
                    ->withResponsiveImages()
                    ->toMediaCollection('product-images', 'product-images');
            }

        }

        return redirect(route('admin.products.edit', $this->product));

    }
    public function removeImage($image_id)
    {
        $this->product->deleteMedia($image_id);
        return $this->notify(__("Image Deleted"));

    }

}