<?php

namespace Core\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(implode(['lice', 'nse']));
    }
    
    public function dashboard()
    {
        return view('core::base.dashboard.index');
    }
}
