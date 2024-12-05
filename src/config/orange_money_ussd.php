<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default ORANGE MONEY CREDENTIALS
    |--------------------------------------------------------------------------
    |
    | Here you will need to fill your orange money credential to be abel to
    | start with any process of the payment.
    |
    */

    "OM_USERNAME" => env("OM_USERNAME", ""),

    "OM_PASSWORD" => env("OM_PASSWORD", ""),

    "OM_PIN" => env("OM_PIN", ""),

    "OM_CHANNEL_USER_MSISDN" => env("OM_CHANNEL_USER_MSISDN", ""),

    "OM_X_AUTH_TOKEN" => env("OM_X_AUTH_TOKEN", ""),

    "OM_NOTIF_URL" => env("OM_NOTIF_URL", "https://www.ynote.cm/notification"),
];
