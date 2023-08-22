<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CreateMapConfig.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 09:32
 */

namespace App\Http\Livewire\Maps;

use App\Models\Maps\Maps;
use Exception;
use File;
use JsonException;
use Livewire\Component;
use Livewire\WithFileUploads;
use SimpleXMLElement;

class CreateMapConfig extends Component
{
    use WithFileUploads;

    public $maps = [
        'md_public_private' => false,
        'md_sprayTypes_available' => false,
        //        'sprayType' => null,
    ];

    public $sprayTypes = true;

    public $submit = false;

    public function mount()
    {
    }

    public function rules()
    {
        if ($this->maps['md_sprayTypes_available']) {
            $sprayTypes = 'nullable';
        } else {
            $sprayTypes = 'required';
        }

        return [
            'maps.md_public_private' => 'required',
            'maps.md_sprayTypes_available' => 'required',
            'maps.modDesc' => 'required',
            'maps.fillType' => 'required',
            'maps.fruitType' => 'required',
            'maps.farmland' => 'required',
            'maps.sprayType' => $sprayTypes,
            'maps.fields' => 'required',
        ];
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function store()
    {
        $team = null;
        if ($this->maps['md_public_private']) {
            $team = auth()->user()->current_team_id;
        }
        if ($this->maps['fillType']) {
            $fillTypeString = File::get($this->maps['fillType']->getRealPath());
            $xml = new SimpleXMLElement($fillTypeString);
            $xmlArray = $this->simpleXMLToArray($xml);
            $fillType = $xmlFillType = [
                'fillTypes' => $xmlArray['fillTypes'],
                'fillTypesConverters' => $xmlArray['fillTypeConverters'],
                'fillTypesCategories' => $xmlArray['fillTypeCategories'],
            ];
        }
        if ($this->maps['fruitType']) {
            $fruitTypeString = File::get($this->maps['fruitType']->getRealPath());
            $xml = new SimpleXMLElement($fruitTypeString);
            $xmlArray = $this->simpleXMLToArray($xml);
            $fruitType = $xmlFillType = [
                'fruitTypes' => $xmlArray['fruitTypes'],
                'fruitTypesConverters' => $xmlArray['fruitTypeConverters'],
                'fruitTypesCategories' => $xmlArray['fruitTypeCategories'],
            ];
        }
        if ($this->maps['farmland']) {
            $farmlandString = File::get($this->maps['farmland']->getRealPath());
            $xml = new SimpleXMLElement($farmlandString);
            $xmlArray = $this->simpleXMLToArray($xml);
            foreach ($xmlArray['farmlands'] as $farmlands) {
                $farmland = [
                    'farmland' => json_encode($farmlands, JSON_THROW_ON_ERROR),
                ];
            }
        }
        if ($this->maps['sprayType']) {
            $sprayTypeString = File::get($this->maps['sprayType']->getRealPath());
            $xml = new SimpleXMLElement($sprayTypeString);
            $xmlArray = $this->simpleXMLToArray($xml);
            foreach ($xmlArray as $sprayTypes) {
                $sprayType = [
                    'sprayType' => json_encode($sprayTypes, JSON_THROW_ON_ERROR),
                ];
            }
        }
        if ($this->maps['fields']) {
            $fields = file($this->maps['fields']->getRealPath(), FILE_IGNORE_NEW_LINES);
            $fieldsArray = [];
            foreach ($fields as $key => $field) {
                $fieldsArray[] = [
                    'field' => explode(' ', $field)[1],
                    'ha' => explode(' ', $field)[4],
                ];
            }
            $fields = $fieldsArray;
        }
        if ($this->maps['modDesc']) {
            $xmlModDescString = File::get($this->maps['modDesc']->getRealPath());
            $xml = new SimpleXMLElement($xmlModDescString);
            foreach ($xml->maps->map as $item => $maps) {
                $maps = [
                    'md_author' => (string) $xml->author,
                    'md_version' => (string) $xml->version,
                    'md_title_de' => (string) $maps->title->de,
                    'md_title_en' => (string) $maps->title->en,
                    'md_desc' => json_encode($maps->description ?? null, JSON_THROW_ON_ERROR),
                    'md_fillTypes' => json_encode($fillType ?? null, JSON_THROW_ON_ERROR),
                    'md_fruitTypes' => json_encode($fruitType ?? null, JSON_THROW_ON_ERROR),
                    'md_farmlands' => json_encode($farmland ?? null, JSON_THROW_ON_ERROR),
                    'md_sprayTypes' => json_encode($sprayTypes ?? null, JSON_THROW_ON_ERROR),
                    'md_fields' => json_encode($fields ?? null, JSON_THROW_ON_ERROR),
                    'team_id' => $team,
                    'user_id' => auth()->id(),
                    'md_public_private' => $this->maps['md_public_private'],
                    'md_sprayTypes_available' => (int) $this->maps['md_sprayTypes_available'],
                ];
                $map = Maps::create($maps);
                toastr()->success('Map added successfully');
            }
        }

        return redirect()->route('settings.admin.maps.index');
    }

    private function simpleXMLToArray($xmlObject, $out = [])
    {
        foreach ($xmlObject as $index => $object) {
            $objectName = $object->getName();
            if (! isset($out[$objectName])) {
                $out[$objectName] = [];
            }
            switch ($objectName) {
                case 'fillTypeConverters':
                    foreach ($xmlObject->fillTypeConverters->fillTypeConverter as $fillTypeConverters) {
                        $name = (string) $fillTypeConverters['name'];
                        foreach ($fillTypeConverters->attributes() as $attribute => $value) {
                            for ($i = 0; $i < $fillTypeConverters->converter->count(); $i++) {
                                foreach ($fillTypeConverters->converter[$i]->attributes() as $converterAttribute => $converter) {
                                    $out['fillTypeConverters'][$name][$i][$attribute] = get_bool($value);
                                    $out['fillTypeConverters'][$name][$i][$converterAttribute] = get_bool($converter);
                                }
                            }
                        }
                    }
                    break;
                case 'fillTypes':
                    foreach ($xmlObject->fillTypes->fillType as $fillType) {
                        $name = (string) $fillType['name'];
                        foreach ($fillType->attributes() as $attribute => $value) {
                            $out['fillTypes'][$name][$attribute] = get_bool($value);
                        }
                        foreach ($fillType->physics->attributes() as $physicsAttribute => $physics) {
                            $out['fillTypes'][$name][$physicsAttribute] = get_bool($physics);
                        }
                        foreach ($fillType->economy->attributes() as $economyAttribute => $economy) {
                            $out['fillTypes'][$name][$economyAttribute] = get_bool($economy);
                            if (isset($fillType->economy->factors)) {
                                foreach ($fillType->economy->factors as $factorsAttribute => $factors) {
                                    for ($i = 0; $i < $fillType->economy->factors->factor->count(); $i++) {
                                        foreach ($fillType->economy->factors->factor[$i]->attributes() as $factorAttribute => $factor) {
                                            $out['fillTypes'][$name][$factorsAttribute][$i][$factorAttribute] = get_bool($factor);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    break;
                case 'fillTypeCategories':
                    foreach ($xmlObject->fillTypeCategories->fillTypeCategory as $key => $fillTypeCategory) {
                        $name = (string) $fillTypeCategory['name'];
                        foreach ($fillTypeCategory->attributes() as $attribute => $value) {
                            $out['fillTypeCategories'][$name]['name'] = get_bool($name);
                            $out['fillTypeCategories'][$name]['text'] = get_bool($fillTypeCategory[0]);
                        }
                    }
                    break;
                case 'fruitTypes':
                    foreach ($xmlObject->fruitTypes->fruitType as $fruitTypes) {
                        $name = (string) $fruitTypes['name'];
                        foreach ($fruitTypes->attributes() as $attribute => $fruitType) {
                            $out['fruitTypes'][$name][$attribute] = get_bool($fruitType);
                        }
                        foreach ($fruitTypes->children() as $children => $child) {
                            foreach ($child->attributes() as $attribute => $childType) {
                                $out['fruitTypes'][$name]['fruitType'][$children][$attribute] = get_bool($childType);
                            }
                        }

                    }
                    break;
                case 'fruitTypeCategories':
                    foreach ($xmlObject->fruitTypeCategories->fruitTypeCategory as $key => $fruitTypeCategory) {
                        $name = (string) $fruitTypeCategory['name'];
                        foreach ($fruitTypeCategory->attributes() as $attribute => $value) {
                            $out['fruitTypeCategories'][$name]['name'] = get_bool($name);
                            $out['fruitTypeCategories'][$name]['text'] = get_bool($fruitTypeCategory[0]);
                        }
                    }
                    break;
                case 'fruitTypeConverters':
                    foreach ($xmlObject->fruitTypeConverters->fruitTypeConverter as $fruitTypeConverters) {
                        $name = (string) $fruitTypeConverters['name'];
                        foreach ($fruitTypeConverters->attributes() as $attribute => $value) {
                            for ($i = 0; $i < $fruitTypeConverters->converter->count(); $i++) {
                                foreach ($fruitTypeConverters->converter[$i]->attributes() as $converterAttribute => $converter) {
                                    $out['fruitTypeConverters'][$name][$i][$attribute] = get_bool($value);
                                    $out['fruitTypeConverters'][$name][$i][$converterAttribute] = get_bool($converter);
                                }
                            }
                        }
                    }
                    break;
                case 'farmlands':
                    foreach ($xmlObject->farmlands as $farmlands) {
                        foreach ($farmlands->attributes() as $attribute => $farmland) {
                            $out['farmlands'][0][$attribute] = get_bool($farmland);
                            for ($i = 0; $i < $farmlands->count(); $i++) {
                                foreach ($farmlands->farmland[$i]->attributes() as $children => $child) {
                                    $out['farmlands'][0]['farmland'][$i][$children] = get_bool($child);
                                }
                            }
                        }
                    }
                    break;
                case 'sprayTypes':
                    foreach ($xmlObject->sprayTypes as $sprayTypes) {
                        for ($i = 0; $i < $sprayTypes->count(); $i++) {
                            $name = (string) $sprayTypes->sprayType[$i]['name'];
                            foreach ($sprayTypes->sprayType[$i]->attributes() as $attribute => $sprayType) {
                                $out['sprayTypes'][$name][$attribute] = get_bool($sprayType);
                            }
                        }
                    }
                    break;
            }
        }

        return $out;
    }

    public function render()
    {
        $this->valid();

        return view('livewire.maps.create-map-config');
    }

    public function valid()
    {
        if ($this->maps['md_sprayTypes_available'] === false) {
            if (! empty($this->maps['sprayType'])) {
                if (! empty($this->maps['modDesc']) and ! empty($this->maps['fillType']) and ! empty($this->maps['fruitType']) and ! empty($this->maps['farmland']) and ! empty($this->maps['fields'])) {
                    $this->submit = true;
                }
            }
        } elseif ($this->maps['md_sprayTypes_available'] == 1) {
            if (! empty($this->maps['modDesc']) and ! empty($this->maps['fillType']) and ! empty($this->maps['fruitType']) and ! empty($this->maps['farmland']) and ! empty($this->maps['fields'])) {
                $this->submit = true;
            } else {
                $this->submit = false;
            }
        }
    }

    public function updatedMapsMdSprayTypesAvailable()
    {
        if ($this->maps['md_sprayTypes_available']) {
            $this->sprayTypes = false;
            $this->maps['sprayType'] = null;
            $this->submit = true;
        } else {
            $this->sprayTypes = true;
            $this->submit = false;
        }
    }
}
