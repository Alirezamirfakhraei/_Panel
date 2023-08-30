<?php

namespace Modules\Panel\Http\Controllers;

use Modules\Panel\Models\Panel;
use Modules\Panel\Repositories\PanelRepo;
use Modules\Share\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index(PanelRepo $panelRepo)
    {
//        $this->authorize('index', Panel::class);
        return view('Panel::index', compact('panelRepo'));
    }
}
