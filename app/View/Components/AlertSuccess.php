<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertSuccess extends Component
{
    public $message;

    public function __construct($message = 'Successfully updated.')
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('components.alert-success');
    }
}
