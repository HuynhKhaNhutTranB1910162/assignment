<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page = 1;

    public $searchTerm = '';
    public $selectedCategory = '';
    public $sortOrder;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
        $this->sortOrder = 'asc';
    }

    public function render(): View
    {
        $query = Product::query();

        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }
        $query->orderBy('original_price', $this->sortOrder);

        $products = $query->paginate(9);

        return  view('livewire.list-product',['products' => $products,]);

    }
}
