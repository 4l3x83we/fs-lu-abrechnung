<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Clock.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 12:17
 */

namespace App\Http\Livewire\Helper;

use Livewire\Component;

class Clock extends Component
{
    public function render()
    {
        return view('livewire.helper.clock');
    }
}
