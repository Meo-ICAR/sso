<?php

return [
    'client_id' => env('AZURE_AD_CLIENT_ID'),
    'client_secret' => env('AZURE_AD_CLIENT_SECRET'),
    'redirect' => env('AZURE_AD_REDIRECT_URI', '/auth/azure/callback'),
    'tenant' => env('AZURE_AD_TENANT_ID', 'common'),
    'proxy' => env('PROXY'),
    'scopes' => [
        'openid',
        'email',
        'profile',
        'User.Read',
    ],
    'endpoint' => [
        'token' => 'https://login.microsoftonline.com/' . env('AZURE_AD_TENANT_ID', 'common') . '/oauth2/v2.0/token',
        'auth' => 'https://login.microsoftonline.com/' . env('AZURE_AD_TENANT_ID', 'common') . '/oauth2/v2.0/authorize',
        'user' => 'https://graph.microsoft.com/v1.0/me',
    ],
];
