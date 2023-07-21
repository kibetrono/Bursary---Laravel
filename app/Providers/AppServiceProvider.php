<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $mailDriver = SystemSetting::where('name', 'mail_driver')->value('value');
        $mailHost = SystemSetting::where('name', 'mail_host')->value('value');
        $mailPort = SystemSetting::where('name', 'mail_port')->value('value');
        $mailUsername = SystemSetting::where('name', 'mail_username')->value('value');
        $mailPassword = SystemSetting::where('name', 'mail_password')->value('value');
        $mailEncryption = SystemSetting::where('name', 'mail_encryption')->value('value');
        $mailFromAddress = SystemSetting::where('name', 'mail_from_address')->value('value');
        $mailFromName = SystemSetting::where('name', 'mail_from_name')->value('value');

        // This code will set the mail settings before the sendPasswordResetEmail() method is called
        Config::set('mail.driver', $mailDriver ?? 'smtp');
        Config::set('mail.host', $mailHost ?? 'smtp.mailgun.org');
        Config::set('mail.port', $mailPort ?? 587);
        Config::set('mail.encryption', $mailEncryption ?? 'tls');
        Config::set('mail.username', $mailUsername);
        Config::set('mail.password', $mailPassword);
        Config::set('mail.from.address', $mailFromAddress ?? 'hello@example.com');
        Config::set('mail.from.name', $mailFromName ?? 'Example');
    }
}
