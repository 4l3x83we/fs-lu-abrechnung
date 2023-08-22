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
use App\Models\Maps\Maps;
use Livewire\Component;

class Auftrag extends Component
{
    public $auftrag = [
        'auftragsart' => true,
    ];

    public $fields;

    public $fieldNr = 1;

    public $eigeneMaschinen;

    public function updatedFieldNr()
    {
        if (empty($this->fieldNr)) {
            return $this->fieldNr = null;
        }

        if (! empty($this->auftrag['feldauftrag'])) {
            $this->updatedAuftragFeldauftrag($this->auftrag['feldauftrag']);
        }

        return $this->fieldNr;
    }

    public function updatedAuftragFeldauftrag($value)
    {
        if (! empty($value)) {
            $auftrag = AuftragsType::findOrFail($value);
            $ha = $this->fields;
            if (! is_null($auftrag)) {
                $kosten = $auftrag->kosten * $ha;
                $this->auftrag['kosten_pro_auftrag'] = numberFormat(round($kosten, -2, PHP_ROUND_HALF_UP));
                if ($this->eigeneMaschinen === true) {
                    $this->auftrag['kosten_fuer_maschinen'] = numberFormat(round($kosten * 0.15, -2, PHP_ROUND_HALF_UP));
                } else {
                    $this->auftrag['kosten_fuer_maschinen'] = null;
                }
            }
        }

        return null;
    }

    public function updatedEigeneMaschinen()
    {
        if ($this->eigeneMaschinen) {
            $this->eigeneMaschinen = true;
        } else {
            $this->eigeneMaschinen = false;
        }
        if (! empty($this->auftrag['feldauftrag'])) {
            $this->updatedAuftragFeldauftrag($this->auftrag['feldauftrag']);
        }
    }

    public function render()
    {
        $maps = Maps::findOrFail(auth()->user()->projectMapID());
        $auftragsType = AuftragsType::all();
        if (isset(json_decode($maps->md_fields, true, 512, JSON_THROW_ON_ERROR)[$this->fieldNr - 1])) {
            $this->fields = json_decode($maps->md_fields, true, 512, JSON_THROW_ON_ERROR)[$this->fieldNr - 1]['ha'];
        }

        return view('livewire.auftrag.auftrag', [
            'fields' => $this->fields,
            'auftragsType' => $auftragsType,
        ]);
    }
}
