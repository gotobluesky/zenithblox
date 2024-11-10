<?php

namespace Core\Http\Controllers;

use Core\Mail\ContactEmail;
use Illuminate\Http\Request;
use Core\Models\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Core\Mail\NewSubscriberWelcome;

class LeadController extends Controller
{
    /**
     * Store a new lead.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company_email' => 'required|email',
            'phone' => 'required|string|max:20',
            'company' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create a new lead record
        $lead = Lead::create([
            'name' => $request->input('name'),
            'company_email' => $request->input('company_email'),
            'phone' => $request->input('phone'),
            'company' => $request->input('company'),
            'msg' => $request->input('msg'),
        ]);
        
        $active_theme = getActiveTheme();
        $contact_option = getThemeOption('contact', $active_theme->id);
        $mail_to = isset($contact_option['contact_sent_email']) ? $contact_option['contact_sent_email'] : null;
        
        $name = $request['name'];
        $email = $request['company_email'];
        $phone = $request['phone'];
        $company = $request['company'];
        $message = $request['msg'];
        $demo = true;
        
        Mail::to($email)->send(new NewSubscriberWelcome($email));
        Mail::to($mail_to)->send(new ContactEmail($name, $email, $phone, $company, $message, $demo));

        // Return success response
        return response()->json([
            'message' => 'Your information saved successfully',
            'status' => 'success',
            'lead' => $lead,
        ], 201);
    }
}
