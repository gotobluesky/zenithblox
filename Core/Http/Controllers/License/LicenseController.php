<?php

namespace Core\Http\Controllers\License;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LicenseController extends Controller
{

    public function activateLicense(Request $request)
    {



                    setEnv('LICENSE_CHECKED', "1");
                    return redirect()->route('core.admin.welcome');



    }
}
