<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomEmail;
use App\Mail\CustomTestMailConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SystemSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage system setting')) {
            $settingsfields = SystemSetting::pluck('value', 'name')->toArray();
            return view('admin.system-settings.index', compact('settingsfields'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create system setting')) {
            return view('admin.system-settings.create');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSetting $systemSetting)
    {
        //
    }

    public function systemSettingsFields(Request $request)
    {
        if (Auth::user()->can('edit system setting')) {

            // dd($request->all());

            // Iterate through each input field
            foreach ($request->except('_token') as $name => $value) {
                // Retrieve the existing system setting or create a new one if it doesn't exist
                $setting = SystemSetting::firstOrNew(['name' => $name]);

                // Update the value of the system setting
                $setting->value = $value;

                // Save the system setting
                $setting->save();
            }

            // Handle logo upload if the form is for brand settings
            if ($request->has('brand_form')) {
                if ($request->hasFile('logo')) {
                    $logoFile = $request->file('logo');
                    // $logoPath = $logoFile->store('public/logos');
                    $logoPath = $logoFile->store('logos', 'public');

                    // Update or create the logo system setting
                    $setting = SystemSetting::firstOrNew(['name' => 'logo']);
                    $setting->value = $logoPath;
                    $setting->save();
                }

                // Handle favicon upload
                if ($request->hasFile('favicon')) {
                    $faviconFile = $request->file('favicon');
                    // $faviconPath = $faviconFile->store('public/favicons');
                    $faviconPath = $faviconFile->store('favicons', 'public');

                    // Update or create the favicon system setting
                    $setting = SystemSetting::firstOrNew(['name' => 'favicon']);
                    $setting->value = $faviconPath;
                    $setting->save();
                }
            }

            // Handle email settings if the form is for email settings
            if ($request->has('email_form')) {
                // Update or create the email settings system settings
                $setting = SystemSetting::firstOrNew(['name' => 'mail_driver']);
                $setting->value = $request->input('mail_driver');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_host']);
                $setting->value = $request->input('mail_host');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_port']);
                $setting->value = $request->input('mail_port');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_username']);
                $setting->value = $request->input('mail_username');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_password']);
                $setting->value = $request->input('mail_password');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_encryption']);
                $setting->value = $request->input('mail_encryption');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_from_address']);
                $setting->value = $request->input('mail_from_address');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'mail_from_name']);
                $setting->value = $request->input('mail_from_name');
                $setting->save();
            }

            // Handle email nottification settings if the form is for email settings
            if ($request->has('email_notification_form')) {
                // Update or create the email settings system settings
                $setting = SystemSetting::firstOrNew(['name' => 'user_signup']);
                $setting->value = $request->input('user_signup');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'create_user']);
                $setting->value = $request->input('create_user');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'create_staff']);
                $setting->value = $request->input('create_staff');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'apply_bursary']);
                $setting->value = $request->input('apply_bursary');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'approve_bursary']);
                $setting->value = $request->input('approve_bursary');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'reject_bursary']);
                $setting->value = $request->input('reject_bursary');
                $setting->save();

                $setting = SystemSetting::firstOrNew(['name' => 'role_assigned']);
                $setting->value = $request->input('role_assigned');
                $setting->save();
            }

            // Redirect back to the settings page with the saved data
            return redirect()->back()->with('success', 'Settings saved successfully!');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function sendTestEmail(Request $request)
    {
        if (Auth::user()->can('edit system setting')) {

            $validatedData = $request->validate([
                'subject' => 'required',
                'body' => 'required',
            ]);

            $emailSettings = SystemSetting::first();

            if (!$emailSettings) {
                return response()->json(['error' => 'Email settings not found!'], 404);
            }

            // Fetch mail settings from the database
            $mailUsername = SystemSetting::where('name', 'mail_username')->value('value');

            Config::set('mail.username', $mailUsername);


            $url = route('system-setting.index');

            $email = new CustomTestMailConfiguration($validatedData['subject'], $validatedData['body'], $url);
            try {
                Mail::to($mailUsername)->send($email);
            } catch (\Exception $e) {
                $response = [
                    'success' => false,
                    'message' => 'E-Mail has been not sent due to failed SMTP configuration',
                    'smtp_error' => (isset($smtp_error)) ? $smtp_error : null
                ];
                return response()->json($response, 500);
            }
            return response()->json(['success' => 'Valid Configurations. Test email sent successfully!']);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function fetchLogo($filename)
    {

        $path = 'public/logos/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        return Response::make($file, 200, ['Content-Type' => $type]);
    }

    public function fetchFavicon($filename)
    {

        $path = 'public/favicons/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        return Response::make($file, 200, ['Content-Type' => $type]);
    }
}
