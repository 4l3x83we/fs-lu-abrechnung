<?php

namespace App\Http\Controllers\Maps;

use App\Http\Controllers\Controller;
use App\Models\Maps\Maps;

class MapsController extends Controller
{
    public function index()
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $maps = [];
        foreach (Maps::get() as $map) {
            $fields = json_decode($map['md_fields'], true, 512, JSON_THROW_ON_ERROR);
            $maps[] = [
                'id' => $map['id'],
                'md_author' => $map['md_author'],
                'md_version' => $map['md_version'],
                'md_title_de' => $map['md_title_de'],
                'md_title_en' => $map['md_title_en'],
                'md_desc' => json_decode($map['md_desc'], true, 512, JSON_THROW_ON_ERROR),
                'md_fields' => count($fields),
                'team_id' => $map['team_id'],
            ];
        }

        return view('settings.admin.maps.index', compact('maps', 'lang'));
    }

    public function create()
    {
        return view('settings.admin.maps.create');
    }
}
