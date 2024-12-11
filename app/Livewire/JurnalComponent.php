<?php

namespace App\Livewire;

use App\Models\Jurnal;
use App\Models\Worker;
use Carbon\Carbon;
use Livewire\Component;

class JurnalComponent extends Component
{
    public $date;
    public $davomatDate;
    public $models;
    public $modelId;

    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->models = Jurnal::all();
        return $this->models;
    }

    public function render()
    {
        return view('livewire.jurnal');
    }
}
