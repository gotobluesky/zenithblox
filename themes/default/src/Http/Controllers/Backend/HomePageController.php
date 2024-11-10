<?php

namespace Theme\Default\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Core\Models\ThemeTranslations;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Theme\Default\Models\HomePageSection;
use Theme\Default\Models\HomeSectionProperties;
use Theme\Default\Http\Requests\HomePageSectionRequest;

class HomePageController extends Controller
{
    /**
     * Will return home page sections
     * 
     * @return mixed
     */
    public function homePageSections()
    {
        $sections = HomePageSection::orderBy('ordering')->get();
        return view('theme/default::backend.homepage.sections')->with(
            [
                'sections' => $sections
            ]
        );
    }
    /**
     * Redirect to new section page
     * @param Request $request
     * @return mixed
     */
    public function newHomePageSection(Request $request)
    {
        if ($request->has('section') && $request->get('section') == 'slider') {
            $slider = HomeSectionProperties::where([
                'key_name' => 'layout',
                'key_value' => 'slider'
            ])->first();
            if ($slider != null) {
                return redirect()->route('theme.default.homePageSection.edit', $slider->section_id);
            }
        };
        return view('theme/default::backend.homepage.new_section');
    }
    /**
     * Will sorting home page sections
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function sortingHomePageSection(Request $request)
    {
        try {
            $position = 0;
            foreach ($request['item'] as $item_id) {
                $position++;
                $section = HomePageSection::find($item_id);
                $section->ordering = $position;
                $section->save();
            }
            cache_clear();
            toastNotification('success', translate('Successfully rearranging'));
        } catch (\Exception $e) {
            toastNotification('error', translate('Action Failed'));
        }
    }
    /**
     * Will remove home page section
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function removeHomePageSection(Request $request)
    {
        try {
            DB::beginTransaction();
            $section = HomePageSection::findOrFail($request['id']);
            $section->section_properties()->delete();
            $section->delete();
            DB::commit();
            cache_clear();
            toastNotification('success', translate('Section deleted successfully'));
            return redirect()->route('theme.default.homePageSections');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Action Failed'));
            return redirect()->back();
        }
    }
    /**
     * Will update home section status
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function updateHomePageSectionStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $section = HomePageSection::findOrFail($request['id']);
            $status = config('settings.general_status.active');
            if ($section->status == config('settings.general_status.active')) {
                $status = config('settings.general_status.in_active');
            }
            $section->status = $status;
            $section->save();
            DB::commit();
            cache_clear();
            toastNotification('success', translate('Status updated successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Action Failed'));
        }
    }
    /**
     * Will return layout options
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function layoutOptions(Request $request)
    {
        $layouts = ['slider', 'ads', 'new_blog', 'featured_blog', 'most_viewed_blog', 'trending_blog', 'category_wise'];
        if (in_array($request['layout'], $layouts)) {
            if ($request['layout'] == 'ads') {
                return view('theme/default::backend.homepage.ads_options')->render();
            }
            return view('theme/default::backend.homepage.' . $request['layout'])->render();
        }
    }
    /**
     * Will return ads layout options
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function adsLayoutOptions(Request $request)
    {
        return view('theme/default::backend.homepage.ads_layout_options')->with(
            [
                'layout' => $request['layout'],
            ]
        );
    }
    /**
     * Will store new home page section
     * 
     * @param HomePageSectionRequest $request
     * @return mixed
     */
    public function storeNewHomePageSection(Request $request)
    {
        try {
            DB::beginTransaction();
            $section = new HomePageSection;
            $section->save();
            foreach ($request->except('_token') as $key => $value) {
                $section_properties = new HomeSectionProperties;
                $section_properties->section_id = $section->id;
                $section_properties->key_name = $key;
                $section_properties->key_value = xss_clean($value);
                $section_properties->save();
            }
            if ($request->has('title') && $request['title'] != null) {
                storeFrontendTranslation(xss_clean($request['title']));
            }
            if ($request->has('btn_title') && $request['btn_title'] != null) {
                storeFrontendTranslation(xss_clean($request['btn_title']));
            }

            DB::commit();
            cache_clear();
            toastNotification('success', translate('New Section added successfully'));
            return redirect()->route('theme.default.homePageSections');
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Save failed'));
            return redirect()->back();
        }
    }

    /**
     * Will redirect edit section page
     * 
     * @param Int $id
     * @return mixed
     */
    public function editHomePageSection($id)
    {
        $section_details = HomePageSection::find($id);
        return view('theme/default::backend.homepage.edit_section')->with(
            [
                'section_details' => $section_details,
            ]
        );
    }

    /**
     * Will update home section
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function updateHomePageSection(Request $request)
    {
        try {
            DB::beginTransaction();
            $section = HomePageSection::find($request['id']);
            $section->section_properties()->delete();
            $section->save();
            foreach ($request->except('_token', 'id') as $key => $value) {
                $section_properties = new HomeSectionProperties;
                $section_properties->section_id = $section->id;
                $section_properties->key_name = $key;
                $section_properties->key_value = xss_clean($value);
                $section_properties->save();
            }

            if ($request->has('title') && $request['title'] != null) {
                storeFrontendTranslation(xss_clean($request['title']));
            }
            if ($request->has('btn_title') && $request['btn_title'] != null) {
                storeFrontendTranslation(xss_clean($request['btn_title']));
            }
            DB::commit();
            cache_clear();
            toastNotification('success', translate('Section updated successfully'));
            return redirect()->route('theme.default.homePageSection.edit', ['id' => $request['id']]);
        } catch (\Exception $e) {
            DB::rollBack();
            toastNotification('error', translate('Update failed'));
            return redirect()->back();
        }
    }
}
