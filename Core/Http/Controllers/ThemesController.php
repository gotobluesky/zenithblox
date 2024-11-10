<?php

namespace Core\Http\Controllers;

use Core\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ThemesController extends Controller
{

    /**
     * Get theme list
     * 
     * @return mixed
     */
    public function index()
    {
        $themes = Themes::all();
        return view('core::base.themes.index', compact('themes'));
    }
    /**
     * Active theme
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();
            $theme = Themes::findOrFail($request->id);
            $theme->is_activated = 1;
            $theme->update();
            DB::table('tl_themes')
                ->whereNotIn('id', [$request->id])
                ->update([
                    'is_activated' => 2
                ]);
            DB::commit();
            toastNotification('success', translate('Theme activate successfully'), 'Success');
            return redirect()->route('core.themes.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Theme activation failed'), 'Failed');
            return redirect()->back();
        }
    }
}
