<?php

namespace App\Livewire\Pages\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $reference;
    public $description;

    public function rules(): array
    {
        $productRequest = new ProductRequest();
        return $productRequest->rules();
    }

    public function clean(): void
    {
        $this->name = '';
        $this->description = '';
        $this->reference = '';
    }

    public function save(): void
    {
        $validated = $this->validate();
        Product::create($validated);

        $this->clean();
        session()->flash('message', 'Producto creado correctamente.');
    }

    public function render()
    {
        return view('livewire.pages.product.create')->layout('layouts.app');
    }
}
