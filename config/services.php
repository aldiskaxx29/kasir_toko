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

    'firebase' => [
        'apiKey' => env('AIzaSyBUeUsOCB_Q3XsaptSBdu2DLdz03tWWGkI'),
        // 'authDomain' => 
    ],

];
// const firebaseConfig = {
//     apiKey: "AIzaSyBUeUsOCB_Q3XsaptSBdu2DLdz03tWWGkI",
//     authDomain: "laravel-crud-9dc37.firebaseapp.com",
//     projectId: "laravel-crud-9dc37",
//     storageBucket: "laravel-crud-9dc37.appspot.com",
//     messagingSenderId: "922417025020",
//     appId: "1:922417025020:web:f769f2f4ff1514b308ac79",
//     measurementId: "G-9YXJ8B82BN"
//   };
