<?php

namespace Theme\Default\Http\Controllers\Frontend;

use Core\Models\TlPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Error;
use Illuminate\Support\Facades\Mail;
use Theme\Default\Mail\ContactEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Theme\Default\Models\HomePageSection;
use Theme\Default\Repositories\PageRepository;
use Theme\Default\Models\HomeSectionProperties;

class FrontendController extends Controller
{
    protected $page_repository;

    public function __construct(PageRepository $page_repository)
    {
        $this->page_repository = $page_repository;
    }

    /**
     * Home Page
     */
    public function home()
    {
        $sections =  Cache::rememberForever('home-page-sliders', function () {
            return HomePageSection::with('section_properties')
                ->where('status', config('settings.general_status.active'))
                ->orderBy('ordering', 'ASC')
                ->get()
                ->pluck('section_properties', 'id')
                ->map(function ($properties) {
                    return $properties->pluck('key_value', 'key_name');
                });
        });

        $slider = Cache::rememberForever('slider_id', function () {
            return HomeSectionProperties::where([
                'key_name' => 'layout',
                'key_value' => 'slider'
            ])->first();
        });

        $slider_id = null;
        if ($slider != null) {
            $slider_id = $slider->section_id;
        }

        if (isActivePluging('pagebuilder')) {

            $page = TlPage::where('is_home', true)->first();

            if ($page != null) {
                $page_sections = '';

                if ($page->page_type == 'builder') {
                    $page_sections = \Plugin\PageBuilder\Helpers\BuilderHelper::getSectionLayoutWidgets($page->id);
                }
                return view('theme/default::frontend.pages.home', compact('sections', 'slider_id', 'page', 'page_sections'));
            }
        }

        return view('theme/default::frontend.pages.home', compact('sections', 'slider_id'));
    }

    /**
     ** Show the Details page in frontend
     * @return View
     */
    public function pageDetails(Request $request)
    {
        try {
            $path = $request->path();
            $request_path_array = explode('/', $path);
            $permalink = end($request_path_array);

            $draft_page = $this->page_repository->findPage($permalink);
            if ($draft_page == null) {
                abort(404);
            }

            if ($draft_page->publish_status == config('default.page_status.draft')) {
                return to_route('theme.default.viewPage');
            }

            $data = [
                DB::raw('GROUP_CONCAT(distinct tl_pages.id) as id'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.title) as title'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.permalink) as permalink'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.parent) as parent'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.visibility) as visibility'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.content) as content'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.page_type) as page_type'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.is_home) as is_home'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.publish_at) as publish_at'),
                DB::raw('GROUP_CONCAT(distinct tl_pages.page_image) as page_image'),
            ];

            $match_case = [
                ['tl_pages.publish_at', '<', currentDateTime()],
                ['tl_pages.publish_status', '=',  config('default.page_status.publish')],
                ['tl_pages.permalink', '=', $permalink],
            ];

            $page = $this->page_repository->getPages($data, $match_case)->first();
            if (!$page) {
                abort(404);
            }

            $page_sections = '';

            if (isActivePluging('pagebuilder')) {
                if($page->page_type == 'builder'){
                    $page_sections = \Plugin\PageBuilder\Helpers\BuilderHelper::getSectionLayoutWidgets($page->id);
                }
            }

            if (isActivePluging('pagebuilder')) {
                if($page->is_home == true){
                    return redirect()->route('theme.default.home');
                }
            }

            return view('theme/default::frontend.pages.page', compact('page', 'page_sections'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Get Content For Password protected page
     * @param Request $request
     * @return Response
     */
    public function getPageContent(Request $request)
    {
        try {
            $permalink = isset($request->permalink) ? $request->permalink : null;

            if (!isset($permalink)) {
                return response()->json(['error' => 'Page Content Loading Failed']);
            }
            $page = $this->page_repository->findPage($permalink);

            if ($request->password == Crypt::decrypt($page->page_password)) {
                $content = xss_clean($page->translation('content', getFrontLocale()));
                return response()->json(['success' => 'Success', 'content' => xss_clean(fix_image_urls($content))]);
            } else {
                return response()->json(['error' => 'Incorrect Password']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Page Content Loading Failed Try']);
        }
    }

    /**
     * change frontend language
     * @param Request $request
     * @return void
     */
    public function changeLanguage(Request $request)
    {
        cache_clear();
        Cache::forget('active-frontend-lang');
        $request->session()->put('api_locale', $request->lang);
    }

    /**
     * send contact email
     * @param Request $request
     * @return void
     */
    public function sendMessage(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                toastNotification('error', front_translate('Please fill in all fields and ensure that the data entered is valid.'));
                return redirect('/contact');
            }

            $active_theme = getActiveTheme();
            $contact_option = getThemeOption('contact', $active_theme->id);
            $mail_to = isset($contact_option['contact_sent_email']) ? $contact_option['contact_sent_email'] : null;

            if (!isset($mail_to)) {
                toastNotification('error', front_translate('Email sending failed. Please contact with admin'));
                return redirect('/contact');
            }

            $mailData = [
                'name' => xss_clean($request['name']),
                'email' => xss_clean($request['email']),
                'message' => xss_clean($request['message']),
                'subject' => xss_clean($request['subject'])
            ];
            Mail::to($mail_to)->send(new ContactEmail($mailData));
            toastNotification('success', front_translate('Email Sent Successfully'));
            return redirect('/contact');
        } catch (\Exception $e) {
            toastNotification('error', front_translate('Email sending failed. Please contact with admin'));
            return redirect('/contact');
        } catch (Error $e) {
            toastNotification('error', front_translate('Email sending failed. Please contact with admin'));
            return redirect('/contact');
        }
    }

    /**
     * change to dark mood or light mood
     * @return void
     */
    public function changeDarkMode()
    {
        $current_mood = session()->get('frontend-mood');
        if ($current_mood == 'dark') {
            $updated_mood = "light";
        } else {
            $updated_mood = "dark";
        }
        session()->put('frontend-mood', $updated_mood);
    }
}
