<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: MarktpreiseController.php
 * User: ${USER}
 * Date: 22.${MONTH_NAME_FULL}.2023
 * Time: 10:18
 */

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class MarktpreiseController extends Controller
{
    public function feldfruechte()
    {
        return view('projects.marktpreise.feldfruechte');
    }

    public function duenger()
    {
        return view('projects.marktpreise.duenger');
    }
}
