<?php

namespace Core\Http\Controllers;

use Core\Mail\TestEmail;
use Illuminate\Http\Request;
use Core\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Core\Http\Requests\TestEmailRequest;

class EmailController extends Controller
{
    /**
     * Will redirect smtp configuration page
     * 
     * @return mixed
     */
    public function smtpConfiguration()
    {
        return view('core::base.email.smtp.smtp_config');
    }
    /**
     * Will update smtp configuration
     * 
     * @param SmtpRequest $request
     * @return mixed 
     */
    public function updateSmtpConfiguration(\Core\Http\Requests\SmtpRequest $request)
    {
        try {
            setEnv('MAIL_MAILER', $request['mail_driver']);
            if ($request['mail_driver'] == 'mailgun') {
                setEnv('MAILGUN_DOMAIN', $request['mailgun_domain']);
                setEnv('MAILGUN_SECRET', $request['mailgun_secret']);
                setEnv('MAIL_HOST', $request['mail_host']);
                setEnv('MAIL_PORT', $request['mail_port']);
                setEnv('MAIL_USERNAME', $request['mail_user_name']);
                setEnv('MAIL_PASSWORD', $request['mail_password']);
                setEnv('MAIL_ENCRYPTION', $request['mail_encryption']);
                setEnv('MAIL_FROM_ADDRESS', $request['mail_from']);
                setEnv('MAIL_FROM_NAME', $request['mail_from_name']);
            } else {
                setEnv('MAIL_HOST', $request['mail_host']);
                setEnv('MAIL_PORT', $request['mail_port']);
                setEnv('MAIL_USERNAME', $request['mail_user_name']);
                setEnv('MAIL_PASSWORD', $request['mail_password']);
                setEnv('MAIL_ENCRYPTION', $request['mail_encryption']);
                setEnv('MAIL_FROM_ADDRESS', $request['mail_from']);
                setEnv('MAIL_FROM_NAME', $request['mail_from_name']);
            }
            toastNotification('success', translate('SMTP configuration updated successfully'));
            return redirect()->route('core.email.smtp.configuration');
        } catch (\Exception $e) {
            toastNotification('error', translate('Update failed'));
            return redirect()->back();
        } catch (\Error $e) {
            toastNotification('error', translate('Update failed'));
            return redirect()->back();
        }
    }
    /**
     * Will send test email
     * 
     * @param TestEmailRequest $request
     * @return mixed
     */
    public function sendTestMail(TestEmailRequest $request)
    {
        try {
            $mailData = [
                "message" => xss_clean($request['message']),
                "subject" => xss_clean($request['subject'])
            ];

            Mail::to($request['email'])->send(new TestEmail($mailData));
            toastNotification('success', translate('A new email sending successfully'));
            return redirect()->route('core.email.smtp.configuration');
        } catch (\Exception $e) {
            toastNotification('error', translate('Email sending failed'));
            return redirect()->back();
        }
    }
    /**
     * will redirect to email template listings
     *
     * @return void
     */
    public function emailTemplates()
    {
        return view('core::base.email.email_templates.index');
    }

    /**
     * update email template
     *
     * @param  Request $request
     * @return mixed
     */
    public function updateEmailTemplate(Request $request)
    {
        $validation = $this->validate($request, [
            'template_id' => 'required|exists:tl_email_template_properties,email_type',
            'subject' => 'required',
            'content' => 'required',
        ]);

        try {
            $template_content = EmailTemplate::where('email_type', $request['template_id'])->first();
            $template_content->subject = xss_clean($request['subject']);
            $template_content->body = $request['content'];
            $template_content->save();

            return response()->json([
                'success' => true,
                'message' => translate("Email template updated successful")
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => translate("Unable to update email template")
            ], 500);
        }
    }

    /**
     * Get email template variables
     */
    public function getEmailTemplateVariables(Request $request)
    {
        $variables = getEmailTemplateVariables($request['template_id']);
        return view('core::base.email.email_templates.email_template_variables', compact('variables'));
    }
}
