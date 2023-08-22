<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AuftragsberechnungController.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 23:07
 */

namespace App\Http\Controllers\Auftrag;

use App\Http\Controllers\Controller;

class AuftragsberechnungController extends Controller
{
    public function auftrag()
    {
        return view('projects.auftragsbearbeitung.auftrag');
    }
}
