<?php

use App\Models\Maps\Maps;

function mapsDBSection()
{
    return Maps::where('id', auth()->user()->projectMapID())->first();
}

function saatgut()
{
    $seeds = [];
    $md_fruitTypes = json_decode(mapsDBSection()->md_fruitTypes, true, 512, JSON_THROW_ON_ERROR);

    foreach ($md_fruitTypes['fruitTypes'] as $index => $fruitType) {
        if (! empty($fruitType['fruitType']['windrow'])) {
            $seeds[strtoupper($index)] = [
                'name' => $fruitType['name'],
                'seedUsagePerSqm' => $fruitType['fruitType']['cultivation']['seedUsagePerSqm'],
                'literPerSqm' => $fruitType['fruitType']['harvest']['literPerSqm'],
                'windrowName' => $fruitType['fruitType']['windrow']['name'],
                'litersPerSqm' => $fruitType['fruitType']['windrow']['litersPerSqm'],
            ];
        } else {
            $seeds[strtoupper($index)] = [
                'name' => $fruitType['name'],
                'seedUsagePerSqm' => $fruitType['fruitType']['cultivation']['seedUsagePerSqm'],
                'literPerSqm' => $fruitType['fruitType']['harvest']['literPerSqm'],
            ];
        }
    }

    return $seeds;
}

function fertilizer()
{
    $sprayType = [];
    $md_sprayType = json_decode(mapsDBSection()->md_sprayTypes, true, 512, JSON_THROW_ON_ERROR);
    foreach ($md_sprayType as $sprayTypes) {
        if (! empty($sprayTypes['sprayGroundType'])) {
            $sprayType[$sprayTypes['name']] = [
                'name' => $sprayTypes['name'],
                'litersPerSecond' => $sprayTypes['litersPerSecond'],
                'type' => $sprayTypes['type'],
                'sprayGroundType' => $sprayTypes['sprayGroundType'],
            ];
        } else {
            $sprayType[$sprayTypes['name']] = [
                'name' => $sprayTypes['name'],
                'litersPerSecond' => $sprayTypes['litersPerSecond'],
                'type' => $sprayTypes['type'],
            ];
        }
    }

    return $sprayType;
}

function maps()
{
    return Maps::findOrFail(auth()->user()->projectMapID());
}

function fillTypes()
{
    $md_fillTypes = json_decode(mapsDBSection()->md_fillTypes, true, 512, JSON_THROW_ON_ERROR);

    return $md_fillTypes['fillTypes'];
}

function inflation($fillType, $month)
{
    return fillTypes()[$fillType]['factors'][$month]['value'];
}

function seedsPrice()
{
    return fillTypes()['SEEDS']['pricePerLiter'];
}

function seedsCalcRate($seeds, $hektar)
{
    $seed = strtoupper($seeds);
    $seedsVolume = (saatgut()[$seed]['seedUsagePerSqm'] * 10000) * (float) $hektar;
    $priceSeed = $seedsVolume * seedsPrice();

    return [
        'seedsVolume' => $seedsVolume,
        'priceSeed' => $priceSeed,
    ];
}

function fertilizerCalcRate($fertilizer, $hektar, $month = 0)
{
    $fertilizer = strtoupper($fertilizer);
    $fertilizerVolumen = (fertilizer()[$fertilizer]['litersPerSecond'] * 36000) * $hektar;
    $priceFertilizer = $fertilizerVolumen * fillTypes()[$fertilizer]['pricePerLiter'];

    return [
        'fertilizerVolumen' => $fertilizerVolumen,
        'priceFertilizer' => $priceFertilizer,
    ];
}
