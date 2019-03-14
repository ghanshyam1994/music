<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'MusicApp'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',


    'app_long_name_first' => 'MusicApp',
    'app_long_name_second' => '',

    'app_short_name_first' => 'M',
    'app_short_name_second' => 'A',

    // show and hide header notification by value 1 and 0
    'show_message' => 0,
    'show_notification' => 0,
    'show_task' => 0,
    'show_profile' => 1,
    'show_setting' => 0,

    // side menu
    'show_unwnated_menu' => 0,
    'show_menu_second_tab' => 0,

    // footer
    'copyright_year' => '2017-2018',
    'company_name' => '',
    'show_version' => 1,
    'version_info' => '1.0',


    // auth register page
    'show_social_button' => 0,
    'terms_condition_link' => '#',

    // auth login page
    'login_social_button' => 0,

    // every form has footer to show them enable this
    'show_form_footer' => 0,
    'form_footer_link' => '#',
    'form_footer_link_text' => 'Footer',

    // pagination

    'pagination_number' => 15,

    'yesptions' => array(array('id' => 1,'value' => 'yes'),array('id' => 2, 'value' => 'no')),
    'cities' => array(array('id' => 1,'value' => 'india'),array('id' => 2, 'value' => 'China'),array('id' => 2, 'value' => 'USA')),
    'gender' => array(array('id' => 1,'value' => 'Male'),array('id' => 2, 'value' => 'Female')),
    'item_unit' => array(array('id' => 1,'value' => 'Unit'),array('id' => 2, 'value' => 'Kg'),array('id' => 3, 'value' => 'Ltr'),
        array('id' => 4, 'value' => 'Pack'),array('id' => 5, 'value' => 'Gram'),array('id' => 6, 'value' => 'Pcs'),array('id' => 7, 'value' => 'ML')),
    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Acekyd\LaravelMP3\LaravelMP3ServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'LaravelMP3' => Acekyd\LaravelMP3\LaravelMP3Facade::class,

    ],
    'debug_blacklist' => [
        '_ENV' => [
            'APP_KEY',
            'DB_PASSWORD',
            'REDIS_PASSWORD',
            'MAIL_PASSWORD',
            'PUSHER_APP_KEY',
            'PUSHER_APP_SECRET',
            'QUEUE_DRIVER',
            'MAIL_DRIVER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_ENCRYPTION',
            'PAGINATE',
            'GOOGLE_MAP_API_KEY',
            'SMS_SENDER_NAME',
            'SMS_API',
            'GOOGLE_CLIENT_ID',
            'GOOGLE_CLIENT_SECRET',
            'GOOGLE_REDIRECT_URL',
            'FACEBOOK_ID',
            'FACEBOOK_SECRET',
            'FACEBOOK_URL',
            'APP_URL',
            'DB_CONNECTION',
            'DB_HOST',
            'DB_PORT',
            'DB_DATABASE',
            'DB_USERNAME',
            'APP_NAME',
            'APP_ENV',
            'REDIS_HOST',
            'APP_DEBUG',
            'APP_LOG_LEVEL',
            'BROADCAST_DRIVER',
            'CACHE_DRIVER',
            'SESSION_DRIVER',
            'SESSION_LIFETIME',
            'REDIS_PORT',
            'DOCUMENT_ROOT',
            'GATEWAY_INTERFACE',
            'HTTP_ACCEPT_LANGUAGE',
            'HTTP_HOST',
            'HTTP_USER_AGENT',
            'HTTP_UPGRADE_INSECURE_REQUESTS',
            'PATH',
            'REDIRECT_UNIQUE_ID',
            'REDIRECT_URL',
            'REMOTE_ADDR',
            'REMOTE_PORT',
            'REQUEST_METHOD',
            'REQUEST_URI',
            'SCRIPT_FILENAME',
            'SCRIPT_NAME',
            'SERVER_ADDR',
            'SERVER_ADMIN',
            'SERVER_NAME',
            'SERVER_PORT',
            'SERVER_PROTOCOL',
            'SERVER_SIGNATURE',
            'SERVER_SOFTWARE',
            'UNIQUE_ID',
            'PHPRC',
            'HTTP_X_REAL_IP'
        ],
        '_SERVER' => [
            'APP_KEY',
            'DB_PASSWORD',
            'REDIS_PASSWORD',
            'MAIL_PASSWORD',
            'PUSHER_APP_KEY',
            'PUSHER_APP_SECRET',
            'HTTP_HOST',
            'SERVER_SIGNATURE',
            'SERVER_SOFTWARE',
            'SERVER_NAME',
            'SERVER_ADDR',
            'SERVER_PORT',
            'DOCUMENT_ROOT',
            'REQUEST_SCHEME',
            'CONTEXT_DOCUMENT_ROOT',
            'SERVER_ADMIN',
            'SCRIPT_FILENAME',
            'REMOTE_PORT',
            'REDIRECT_URL',
            'REQUEST_METHOD',
            'REQUEST_URI',
            'SCRIPT_NAME',
            'PHP_SELF',
            'APP_NAME',
            'APP_ENV',
            'APP_URL',
            'DB_CONNECTION',
            'DB_HOST',
            'DB_PORT',
            'DB_DATABASE',
            'DB_USERNAME',
            'DB_PASSWORD',
            'SESSION_LIFETIME',
            'QUEUE_DRIVER',
            'MAIL_DRIVER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_ENCRYPTION',
            'PAGINATE',
            'GOOGLE_MAP_API_KEY',
            'SMS_SENDER_NAME',
            'SMS_API',
            'GOOGLE_CLIENT_ID',
            'GOOGLE_CLIENT_SECRET',
            'GOOGLE_REDIRECT_URL',
            'FACEBOOK_ID',
            'FACEBOOK_SECRET',
            'FACEBOOK_URL',
            'REDIS_HOST',
            'REDIS_PORT',
            'BROADCAST_DRIVER',
            'CACHE_DRIVER',
            'SESSION_DRIVER',
            'APP_LOG_LEVEL',
            'APP_DEBUG',
            'REQUEST_TIME_FLOAT',
            'REQUEST_TIME',
            'SERVER_PROTOCOL',
            'GATEWAY_INTERFACE',
            'HTTP_ENCKEY',
            'HTTP_ENCTOKEN',
            'HTTP_EXTID',
            'HTTP_COOKIE',
            'HTTP_ACCEPT_LANGUAGE',
            'HTTP_ACCEPT',
            'REDIRECT_STATUS',
            'HTTP_X_REAL_IP',
            'PATH',
            'REDIRECT_UNIQUE_ID',
            'REMOTE_ADDR',
            'UNIQUE_ID',
            'PHPRC',
            'OPENSSL_CONF',
            'RE_CAP_SITE',
            'RE_CAP_SECRET',

        ],
        '_POST' => [
            'password',
        ],
        '_COOKIE'=>[
            'PHPSESSID',
            'user_logged_in',
            'XSRF-TOKEN'
        ],
    ],

];
