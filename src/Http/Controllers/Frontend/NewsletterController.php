<?php

namespace Theme\Default\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Spatie\Newsletter\NewsletterFacade;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     ** Newsletter Subscriber Store
     * @param \Illuminate\Http\Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message'=> front_translate('Please Enter a Valid Email')
            ]);
        }

        $mailchimp_api_key = env('MAILCHIMP_APIKEY');
        $mailchimp_list_id = env('MAILCHIMP_LIST_ID');

        if($mailchimp_api_key == '' || $mailchimp_list_id == '' ){
            return response()->json([
                'success' => false,
                'message'=> front_translate('Newsletter Subscribing Failed. Please Contact With Admin')
            ]);
        }

        if (!NewsletterFacade::isSubscribed($request->email)) {
            NewsletterFacade::subscribePending($request->email);
            return response()->json([
                'success' => true,
                'message'=> front_translate('Please Check your Email to confirm your Subscription')
            ]);
        }

        return response()->json([
            'success' => true,
            'message'=> front_translate('This Email is already Subscribed')
        ]);
    }
}
