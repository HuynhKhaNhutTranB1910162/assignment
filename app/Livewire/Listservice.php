<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Listservice extends Component
{
    public $searchTerm = '';

    public $services;

    public function render()
    {
        $query = Service::query();

        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        $this->services = $query->get();

        return view('livewire.listservice');
    }
}
