<?php

namespace App\Exceptions;

use Throwable;
use Core\Exceptions\PluginException;
use Core\Exceptions\ThemeRequiredPluginException;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof PostTooLargeException) {
            return response()->view('core::base.errors.500', ['message' => 'File size is too Large', 'title' => 'Large File Size', 'route' => '#'], 500);
        }

        if ($exception instanceof PluginException) {
            return response()->view('core::base.errors.plugin_exception', ['message' => $exception->getMessage(), 'title' => 'Large File Size', 'route' => '#'], 500);
        }
        
        if ($exception instanceof ThemeRequiredPluginException) {
            return response()->view('core::base.errors.theme_required_plugin_failed', ['message' => $exception->getMessage(), 'title' => 'Large File Size', 'route' => '#'], 500);
        }

        // 404 Page based on theme
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                if (strpos($request->url(), '/admin') === false) {
                    $active_theme = getActiveTheme();
                    $error_page_location = 'theme/'.$active_theme->location.'::errors.404';
                    return response()->view($error_page_location);
                }
            }
        }

        return parent::render($request, $exception);
    }
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
