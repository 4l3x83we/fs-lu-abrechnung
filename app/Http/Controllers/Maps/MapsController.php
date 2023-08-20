<?php

namespace App\Http\Controllers\Maps;

use App\Http\Controllers\Controller;
use App\Models\Maps\Maps;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index()
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $maps = Maps::all();

        return view('settings.admin.maps.index', compact('maps', 'lang'));
    }

    public function store(Request $request)
    {
        $icon = asset('images/icon.dds');
        $data = json_decode(curl_post('http://api.rest7.com/v1/image_convert.php', 'file=C:\fakepath\icon_iit3.dds&format=png&api_key=47f94ddc8c40d14ae9b561b4084e1e080d9f68be'));

        /*if (@$data->success !== 1) {
            exit('Failed');
        }*/
        //        $image = file_get_contents($data->file);

        dd($request->md_icon, $icon);

        toastr()->success('Map erfolgreich hinzugefügt');

        return redirect()->route('settings.admin.maps.index');
    }

    public function create()
    {
        return view('settings.admin.maps.create');
    }

    public function show(Maps $maps)
    {
        return $maps;
    }

    public function update(Request $request, Maps $maps)
    {
        $request->validate(['md_author' => ['nullable'], 'md_version' => ['nullable'], 'md_icon' => ['nullable'], 'md_title' => ['nullable'], 'md_desc' => ['nullable'], 'md_preview' => ['nullable'], 'md_fillTypes' => ['nullable'], 'md_fruitTypes' => ['nullable'], 'md_farmlands' => ['nullable'], 'md_sprayTypes' => ['nullable'], 'md_fields' => ['nullable'], 'md_sprayTypes_available' => ['nullable'], 'team_id' => ['nullable', 'integer'], 'user_id' => ['nullable', 'integer'], 'md_public_private' => ['nullable'], 'md_ModDesc' => ['nullable']]);

        $maps->update($request->validated());

        return $maps;
    }

    public function destroy(Maps $maps)
    {
        $maps->delete();

        return response()->json();
    }
}
