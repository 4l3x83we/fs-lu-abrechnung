<?php

namespace App\Http\Livewire\Marktpreise;

use App\Models\Maps\Maps;
use Livewire\Component;

class Duenger extends Component
{
    public $duenger;

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

        foreach ($md_fillTypes['fillTypes'] as $fruit => $fillType) {
            if (! empty($fillType['pricePerLiter'])) {
                if (! empty($fillType['factors'])) {
                    $factors = [];
                    $months = [];
                    for ($i = 0; $i <= count($fillType['factors']) - 1; $i++) {
                        $factors[$fillType['factors'][$i]['period']] = $fillType['factors'][$i]['value'];
                        foreach (months()['short'] as $item => $month) {
                            $months[$month] = round(marktPreis($fillType['pricePerLiter'], $fillType['factors'][$item]['value'], $this->modi) * 1000);
                        }
                    }
                } else {
                    $factors = [];
                    $months = [];
                    for ($i = 0; $i < 11; $i++) {
                        foreach (months()['short'] as $item => $month) {
                            $factors[$month] = 1;
                            $months[$month] = round(marktPreis($fillType['pricePerLiter'], 1, $this->modi) * 1000);
                        }
                    }
                }
                $duenger[$fillType['name']] = [
                    'name' => 'fillTypes.'.$fillType['name'],
                    'pricePerLiter' => $fillType['pricePerLiter'],
                    'perLiter' => $fillType['pricePerLiter'] * 1,
                    'max' => round(marktPreis($fillType['pricePerLiter'], max($factors), $this->modi) * 1000),
                    'min' => round(marktPreis($fillType['pricePerLiter'], min($factors), $this->modi) * 1000),
                    'normal' => round(marktPreis($fillType['pricePerLiter'], 1, $this->modi) * 1000),
                    'factor' => $months,
                ];
            }
        }
        $this->duenger = [
            'LIQUIDFERTILIZER' => $duenger['LIQUIDFERTILIZER'],
            'LIQUIDMANURE' => $duenger['LIQUIDMANURE'],
            'LIME' => $duenger['LIME'],
            'HERBICIDE' => $duenger['HERBICIDE'],
            'MANURE' => $duenger['MANURE'],
            'FERTILIZER' => $duenger['FERTILIZER'],
            'DIGESTATE' => $duenger['DIGESTATE'],
            'SEEDS' => $duenger['SEEDS'],
        ];

        return view('livewire.marktpreise.duenger');
    }
}
