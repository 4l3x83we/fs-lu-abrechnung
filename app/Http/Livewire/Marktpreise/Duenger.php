<?php

namespace App\Http\Livewire\Marktpreise;

use App\Models\Maps\Maps;
use Livewire\Component;

class Duenger extends Component
{
    public $feldfruechte;

    public $modi = 'Schwer';

    public function updatedModi($value)
    {
        $this->modi = $value;
    }

    public function render()
    {
        $fillTypes = [];
        $feldfruechte = Maps::where('id', auth()->user()->projectMapID())->first()->md_fillTypes;
        $md_fillTypes = json_decode($feldfruechte, true);

        return view('livewire.marktpreise.duenger');
    }
}
