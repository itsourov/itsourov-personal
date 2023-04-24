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


    protected function rules()
    {
        return [

            'product.title' => 'required',
            'product.slug' => 'required | unique:products,slug,' . $this->product->id,
            'product.short_description' => 'required',
            'product.long_description' => 'required',
            'product.selling_price' => 'required|numeric|gt:0',
            'product.original_price' => 'required|numeric|gt:0',


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
            $validatedImage = $this->validate([
                'featuredImage' => 'image|max:1500'
            ]);

            $this->product->clearMediaCollection('product-thumbnails');
            $this->product->addMedia($validatedImage['featuredImage'])
                ->withResponsiveImages()
                ->toMediaCollection('product-thumbnails', 'product-thumbnails');
        }

        return redirect(route('admin.products.index'));

    }
    public function dismiss()
    {

    }
}