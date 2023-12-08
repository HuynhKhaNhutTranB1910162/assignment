<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Listservice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $page = 1;

    public $searchTerm = '';


    public function render()
    {
        $query = Service::query();

        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        $services = $query->paginate(3);

        return view('livewire.listservice',['services' => $services,]);
    }
}
