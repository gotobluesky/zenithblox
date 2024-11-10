<?php

namespace Core\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\Controller;
use Core\Models\TlBlog;
use Core\Models\TlPage;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Route;

class SystemController extends Controller
{

    /**
     * Will clear system  cache
     */
    public function clearSystemCache()
    {
        try {
            cache_clear();
            toastNotification('success', translate('Cache clear successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('Cache clear failed'));
        }
    }

    // Generate sitemap
    public function generateSitemap()
    {
        ini_set('max_execution_time', 900);
        try {
            $posts = TlBlog::where('is_publish', config('settings.blog_status.publish'))->where('publish_at', '<', currentDateTime())->get();

            $pages = TlPage::where('publish_status', config('default.page_status.publish'))->where('publish_at', '<', currentDateTime())->get();

            Sitemap::create()
                ->add($posts)
                ->add($pages)
                ->writeToFile(public_path('sitemap.xml'));

                return response()->json([
                    'message' => translate('Site Map Generated successfully')
                ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => translate('Site Map Generating Failed')
            ], 500);
        }

    }
}
