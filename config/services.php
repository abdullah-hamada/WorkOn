<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '1072140743410665',
        'client_secret' => '6f7c4ee489cdec97bec0ff4b7962629b',
        'redirect' => config('app.url') . '/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '603210543968-u0si91kggi7gs4ksc6skpth49u3rrm6n.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => config('app.url') . 'login/google/callback',
    ],

    'linkedin' => [
        'client_id' => '77i25iduf8etvf',
        'client_secret' => 'qPaW4wAkGtLiAj0Z',
        'redirect' => config('app.url'). 'login/linkedin/callback',
    ],



];
