<?php

namespace App\Providers;

use App\EmailIntegration;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = EmailIntegration::first();
        if ($settings) {
            $config = array(
                'driver'     => $settings->driver,
                'host'       => $settings->host,
                'port'       => $settings->port,
                'username'   => $settings->user_name,
                'password'   => $settings->password,
                'encryption' => $settings->encryption,
                'from'       => array('address' => $settings->form_address, 'name' => $settings->form_name),
                'sendmail'   => '/usr/sbin/sendmail -bs',
                'pretend'    => false,
            );
            \Config::set('mail', $config);
        } 
    }
}
