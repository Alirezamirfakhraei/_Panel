<?php

namespace Modules\Panel\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Panel\Models\Panel;
use Modules\Panel\Repositories\PanelRepo;

class PanelController extends Controller
{
    public function index(PanelRepo $panelRepo)
    {
//        $this->authorize('index', Panel::class);
        return view('Panel::index', compact('panelRepo'));
    }
}
