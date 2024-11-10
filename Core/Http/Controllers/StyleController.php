<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StyleController extends Controller
{
    /**
     * switch dark or light mood
     * 
     * @return void
     */
    public function changeMood(Request $request)
    {
        $current_mood = session()->get('mood');
        $updated_mood = "light";
        if ($current_mood == 'dark') {
            $updated_mood = "light";
        } else {
            $updated_mood = "dark";
        }
        session()->put('mood', $updated_mood);

        return session()->get('mood');
    }
}
