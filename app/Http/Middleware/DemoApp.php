<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class DemoApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_DEMO') === true) {
            if (request()->isXmlHttpRequest()) {
                
                if (isset($request->action) && $request->action == 'delete_all') {
                  return $this->returnJsonResponse();
                }

                if(FacadesRequest::routeIs('core.blog.comment.bulk.action')){
                    return $this->returnJsonResponse();
                }

                if(!isset($request->action)){
                  return $this->returnJsonResponse();
                }
            } else {
                toastNotification('error', translate('This action is not available in Demo'));
                return redirect()->back();
            }
        }
        return $next($request);
    }

    public function returnJsonResponse()
    {
        return response()->json([
            'demo_mode' => true,
            'message' => translate('This action is not available in Demo')
        ]);
    }
}
