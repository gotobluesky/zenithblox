<?php

namespace Plugin\DemoPlugin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DemoPluginController extends Controller
{
    /**
     * Will return demo plugin page sections
     * 
     * @return View
     */
    public function index(Request $request)
    {
        return view('plugin/demo-plugin::index');
    }

}
