<?php

function get_user()
{
    $token = 'aedaa4de-29d9-43dc-a322-dc5c0e714d31';
    $apiKey = '3363fe3e6a8b412bb6016fcc1db5c98f';

    $post_data = [
        'providerCallbackHost' => 'http://localhost',
    ];
    //$url="https://sandbox.momodeveloper.mtn.com/v1_0/apiuser";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl, CURLOPT_URL, 'https://sandbox.momodeveloper.mtn.com/v1_0/apiuser');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $curl,
        CURLOPT_HTTPHEADER,
        [
            'Content-Type: application/json',
            'X-Reference-Id: '.$token,
            'Ocp-Apim-Subscription-Key: '.$apiKey,
        ]
    );

    $result = curl_exec($curl);

    $result = curl_exec($curl);
    if (! $result) {
        exit('Connection Failure');
    }
    curl_close($curl);
    echo $result;
}

echo get_user();
