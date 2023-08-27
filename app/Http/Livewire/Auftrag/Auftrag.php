<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Auftrag.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 21:25
 */

namespace App\Http\Livewire\Auftrag;

use App\Models\Auftrag\AuftragsType;
use Livewire\Component;

class Auftrag extends Component
{
    public $auftrag = [
        'auftragsart' => true,
        'fieldNr' => 1,
        'feldauftrag' => null,
        'eigeneMaschinen' => true,
        'changeHA' => null,
        'kosten_pro_auftrag' => 0,
        'kosten_pro_auftragBlank' => 0,
        'kosten_fuer_maschinen' => 0,
        'kosten_fuer_maschinenBlank' => 0,
    ];

    public $duenger = [
        'monthDuenger' => 0,
        'kostenDuenger' => 0,
        'kostenDuengerBlank' => 0,
        'duengerChange' => null,
    ];

    public $saatgut = [
        'kostenSaatgut' => 0,
        'monthSaatgut' => 0,
        'kostenSaatgutBlank' => 0,
    ];

    public $fields;

    public $fieldsChange;

    public $ha;

    public $eigeneMaschinen;

    public $switchHa = false;

    public $changeSwitchHa;

    public $auftragsType;

    public $duengerChangeMonth = false;

    public $saatgutChangeMonth = false;

    public $costOverview = [
        'order' => 0,
        'machinery' => 0,
        'fertilizer' => 0,
        'seed' => 0,
        'total' => 0,
    ];

    public function messages()
    {
        return [
            'auftrag.feldauftrag' => __('Order').' muss ausgefüllt werden.',
            'auftrag.kosten_pro_auftrag' => __('cost per order').' muss ausgefüllt werden.',
            'auftrag.changeHA' => __('hectare').' muss ausgefüllt werden.',
            'auftrag.fieldNr' => __('Field Number').' muss ausgefüllt werden.',
        ];
    }

    public function rules()
    {
        if ((! $this->auftrag['ha']) > 0 and empty($this->auftrag['changeHA'])) {
            $changeHA = 'required';
            $ha = 'nullable';
        } else {
            $changeHA = 'nullable';
            $ha = 'required';

        }

        return [
            'auftrag.auftragsart' => 'required',
            'auftrag.fieldNr' => 'required',
            'auftrag.ha' => $ha,
            'auftrag.changeHA' => $changeHA,
            'auftrag.feldauftrag' => 'required',
            'auftrag.feldauftragName' => 'nullable',
            'auftrag.eigeneMaschinen' => 'nullable',
            'auftrag.kosten_pro_auftrag' => 'required',
            'auftrag.kosten_fuer_maschinen' => 'nullable',
            'duenger.duengerChange' => 'nullable',
            'duenger.monthDuenger' => 'nullable',
            'duenger.litersPerSecond' => 'nullable',
            'duenger.kostenDuenger' => 'nullable',
            'saatgut.seedUsagePerSqm' => 'nullable',
            'saatgut.monthSaatgut' => 'nullable',
            'saatgut.kostenSaatgutBlank' => 'nullable',
            'saatgut.saatgutChange' => 'nullable',
            'costOverview.order' => 'nullable',
            'costOverview.machinery' => 'nullable',
            'costOverview.fertilizer' => 'nullable',
            'costOverview.seed' => 'nullable',
            'costOverview.total' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->auftragsType = AuftragsType::all();
    }

    public function store()
    {
        $validatedData = $this->validate();
        $order = [
            'auftrag' => json_encode($validatedData['auftrag'] ?? null),
            'fertilizer' => json_encode($validatedData['duenger'] ?? null),
            'seed' => json_encode($validatedData['saatgut'] ?? null),
            'costOverview' => json_encode($validatedData['costOverview']),
        ];
        dd($validatedData, $order);
    }

    public function updatedChangeSwitchHa()
    {
        if ($this->changeSwitchHa) {
            $this->switchHa = true;
        } else {
            $this->switchHa = false;
        }
        $this->updatedSwitchHa();
    }

    public function updatedSwitchHa()
    {
        if ($this->switchHa) {
            $this->updatedAuftragChangeHA();
        } else {
            return $this->auftrag['ha'];
        }

        return null;
    }

    public function updatedAuftragChangeHA()
    {
        if (! empty($this->auftrag['changeHA'])) {
            return $this->auftrag['changeHA'];
        }

        return null;
    }

    public function updatedAuftragEigeneMaschinen()
    {
        if ($this->auftrag['eigeneMaschinen']) {
            $this->auftrag['eigeneMaschinen'] = true;
        } else {
            $this->auftrag['eigeneMaschinen'] = false;
        }
        $this->updatedSwitchHa();
        $this->updatedAuftragFeldauftrag($this->auftrag['feldauftrag']);
    }

    public function updatedAuftragFeldauftrag($value)
    {
        if (! empty($value)) {
            $auftrag = AuftragsType::findOrFail($value);
            $this->auftrag['feldauftragName'] = $auftrag['name'];
            if (! is_null($auftrag)) {
                $kosten = $auftrag->kosten * $this->auftrag['ha'];
                $this->auftrag['kosten_pro_auftragBlank'] = round($kosten, -2, PHP_ROUND_HALF_UP);
                $this->auftrag['kosten_pro_auftrag'] = numberFormat(round($kosten, -2, PHP_ROUND_HALF_UP));
                if ($this->auftrag['eigeneMaschinen']) {
                    $this->auftrag['kosten_fuer_maschinenBlank'] = round($kosten * 0.15, -2, PHP_ROUND_HALF_UP);
                    $this->auftrag['kosten_fuer_maschinen'] = numberFormat(round($kosten * 0.15, -2, PHP_ROUND_HALF_UP));
                } else {
                    $this->auftrag['kosten_fuer_maschinen'] = null;
                    $this->auftrag['kosten_fuer_maschinenBlank'] = null;
                }
            }
        } else {
            $this->auftrag['kosten_pro_auftrag'] = numberFormat(0);
            $this->auftrag['kosten_fuer_maschinen'] = numberFormat(0);
        }

        return null;
    }

    public function updatedAuftragFieldNr()
    {
        $this->updatedDuengerDuengerChange();
        $this->updatedSaatgutSaatgutChange();
    }

    // Duenger Calculation
    public function updatedDuengerDuengerChange(): void
    {
        if (! empty($this->duenger['duengerChange'])) {
            $this->duenger['litersPerSecond'] = fertilizerCalcRate($this->duenger['duengerChange'], $this->auftrag['ha'])['fertilizerVolumen'];
            if (! empty(fillTypes()[$this->duenger['duengerChange']]['factors'])) {
                $this->duengerChangeMonth = true;
                $inflation = inflation($this->duenger['duengerChange'], $this->duenger['monthDuenger']);
                $this->duenger['kostenDeungerBlank'] = fertilizerCalcRate($this->duenger['duengerChange'], $this->auftrag['ha'])['priceFertilizer'] * $inflation;
                $this->duenger['kostenDuenger'] = numberFormat(fertilizerCalcRate($this->duenger['duengerChange'], $this->auftrag['ha'])['priceFertilizer'] * $inflation);
            } else {
                $this->duengerChangeMonth = false;
                $this->duenger['kostenDeungerBlank'] = fertilizerCalcRate($this->duenger['duengerChange'], $this->auftrag['ha'])['priceFertilizer'];
                $this->duenger['kostenDuenger'] = numberFormat(fertilizerCalcRate($this->duenger['duengerChange'], $this->auftrag['ha'])['priceFertilizer']);
            }
        } else {
            $this->duenger['litersPerSecond'] = null;
            $this->duenger['kostenDeungerBlank'] = 0;
            $this->duenger['kostenDuenger'] = numberFormat(0);
        }
    }

    // Saatgut Calculation
    public function updatedSaatgutSaatgutChange()
    {
        if (! empty($this->saatgut['saatgutChange'])) {
            $this->saatgut['seedUsagePerSqm'] = seedsCalcRate($this->saatgut['saatgutChange'], $this->auftrag['ha'])['seedsVolume'];
            $inflation = inflation('SEEDS', $this->saatgut['monthSaatgut']);
            $this->saatgut['kostenSaatgutBlank'] = seedsCalcRate($this->saatgut['saatgutChange'], $this->auftrag['ha'])['priceSeed'] * $inflation;
            $this->saatgut['kostenSaatgut'] = numberFormat(seedsCalcRate($this->saatgut['saatgutChange'], $this->auftrag['ha'])['priceSeed'] * $inflation);
        } else {
            $this->saatgut['seedUsagePerSqm'] = null;
            $this->saatgut['kostenSaatgutBlank'] = 0;
            $this->saatgut['kostenSaatgut'] = numberFormat(0);
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if (! empty($this->auftrag['fieldNr'])) {
            if (isset(json_decode(maps()->md_fields, true, 512, JSON_THROW_ON_ERROR)[$this->auftrag['fieldNr'] - 1]) and empty($this->switchHa)) {
                $this->auftrag['ha'] = json_decode(maps()->md_fields, true, 512, JSON_THROW_ON_ERROR)[$this->auftrag['fieldNr'] - 1]['ha'];
                $this->updatedAuftragFeldauftrag($this->auftrag['feldauftrag']);
                $this->updatedDuengerDuengerChange();
                $this->updatedSaatgutSaatgutChange();
            } else {
                if (! empty($this->updatedAuftragChangeHA())) {
                    $this->auftrag['ha'] = $this->updatedAuftragChangeHA();
                    $this->updatedAuftragFeldauftrag($this->auftrag['feldauftrag']);
                    $this->updatedDuengerDuengerChange();
                    $this->updatedSaatgutSaatgutChange();
                } else {
                    $this->auftrag['ha'] = 0;
                    $this->updatedAuftragFeldauftrag($this->auftrag['feldauftrag']);
                    $this->updatedDuengerDuengerChange();
                    $this->updatedSaatgutSaatgutChange();
                }
            }
        }

        $total = $this->auftrag['kosten_pro_auftragBlank'] + $this->auftrag['kosten_fuer_maschinenBlank'] + $this->duenger['kostenDeungerBlank'] + $this->saatgut['kostenSaatgutBlank'];

        $this->costOverview = [
            'order' => $this->auftrag['kosten_pro_auftragBlank'],
            'machinery' => $this->auftrag['kosten_fuer_maschinenBlank'],
            'fertilizer' => $this->duenger['kostenDeungerBlank'],
            'seed' => $this->saatgut['kostenSaatgutBlank'],
            'total' => $total,
        ];

        return view('livewire.auftrag.auftrag', [
            'fields' => $this->auftrag['ha'],
        ]);
    }
}
