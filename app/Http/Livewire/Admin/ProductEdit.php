<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    public Product $product;
    public $title = 'Edit Product';
    public $featuredImage;
    public $productImages = [];


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
            'productImages.*' => 'nullable|image|max:50'


        ];
    }

    public function render()
    {
        return view('livewire.admin.product-edit');
    }

    public function mount(Product $product)
    {
        $this->product = $product;

    }

    public function update()
    {


        $this->validate();

        $this->product->save();


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

        return redirect(request()->header('Referer'));

    }
    public function dismiss()
    {

    }
}