<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Alkhachatryan\LaravelWebConsole\LaravelWebConsole;

Route::get('/console', function () {
    return LaravelWebConsole::show();
});
Route::get('/console/details', function () {
    return [
        'APP_NAME'=> env('APP_NAME'),
        'APP_ENV'=> env('APP_ENV'),
        'APP_KEY'=> env('APP_KEY'),
        'APP_DEBUG'=> env('APP_DEBUG'),
        'APP_URL'=> env('APP_URL'),

        'LOG_CHANNEL'=> env('LOG_CHANNEL'),
        'LOG_DEPRECATIONS_CHANNEL'=> env('LOG_DEPRECATIONS_CHANNEL'),
        'LOG_LEVEL'=> env('LOG_LEVEL'),

        'DB_CONNECTION'=> env('DB_CONNECTION'),
        'DB_HOST'=> env('DB_HOST'),
        'DB_PORT'=> env('DB_PORT'),
        'DB_DATABASE'=> env('DB_DATABASE'),
        'DB_USERNAME'=> env('DB_USERNAME'),
        'DB_PASSWORD'=> env('DB_PASSWORD'),

        'BROADCAST_DRIVER'=> env('BROADCAST_DRIVER'),
        'CACHE_DRIVER'=> env('CACHE_DRIVER'),
        'FILESYSTEM_DRIVER'=> env('FILESYSTEM_DRIVER'),
        'QUEUE_CONNECTION'=> env('QUEUE_CONNECTION'),
        'SESSION_DRIVER'=> env('SESSION_DRIVER'),
        'SESSION_LIFETIME'=> env('SESSION_LIFETIME'),

        'MEMCACHED_HOST'=> env('MEMCACHED_HOST'),

        'REDIS_HOST'=> env('REDIS_HOST'),
        'REDIS_PASSWORD'=> env('REDIS_PASSWORD'),
        'REDIS_PORT'=> env('REDIS_PORT'),

        'MAIL_MAILER'=> env('MAIL_MAILER'),
        'MAIL_HOST'=> env('MAIL_HOST'),
        'MAIL_PORT'=> env('MAIL_PORT'),
        '#MAIL_USERNAME'=> env('#MAIL_USERNAME'),
        'MAIL_USERNAME'=> env('MAIL_USERNAME'),
        '#MAIL_PASSWORD'=> env('#MAIL_PASSWORD'),
        'MAIL_PASSWORD'=> env('MAIL_PASSWORD'),
        'MAIL_ENCRYPTION'=> env('MAIL_ENCRYPTION'),
        '#MAIL_FROM_ADDRESS'=> env('#MAIL_FROM_ADDRESS'),
        'MAIL_FROM_ADDRESS'=> env('MAIL_FROM_ADDRESS'),
        'MAIL_FROM_NAME'=> env('MAIL_FROM_NAME'),

        'AWS_ACCESS_KEY_ID'=> env('AWS_ACCESS_KEY_ID'),
        'AWS_SECRET_ACCESS_KEY'=> env('AWS_SECRET_ACCESS_KEY'),
        'AWS_DEFAULT_REGION'=> env('AWS_DEFAULT_REGION'),
        'AWS_BUCKET'=> env('AWS_BUCKET'),
        'AWS_USE_PATH_STYLE_ENDPOINT'=> env('AWS_USE_PATH_STYLE_ENDPOINT'),

        'PUSHER_APP_ID'=> env('PUSHER_APP_ID'),
        'PUSHER_APP_KEY'=> env('PUSHER_APP_KEY'),
        'PUSHER_APP_SECRET'=> env('PUSHER_APP_SECRET'),
        'PUSHER_APP_CLUSTER'=> env('PUSHER_APP_CLUSTER'),

        'MIX_PUSHER_APP_KEY'=> env('MIX_PUSHER_APP_KEY'),
        'MIX_PUSHER_APP_CLUSTER'=> env('MIX_PUSHER_APP_CLUSTER'),
        'TELESCOPE_ENABLED'=> env('TELESCOPE_ENABLED')
    ];
});