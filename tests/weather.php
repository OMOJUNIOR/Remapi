<?php

namespace Omojunior\remapi;

require_once 'vendor/autoload.php';

$city = 'Freetown';

$url = "http://api.weatherapi.com/v1/current.json?&key=abf85d9145ca4245a1c53418220408&q=$city";

if (empty($city) || $city === '') {
    $error = 'Invalid city';
} else {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('get', $url);
    echo '<pre>';
    $forecasts = json_decode($response->getBody(), true);
    echo '</pre>';
}

?>

<div>

<?php foreach ($forecasts as $forecast) { ?>
    <blockquote>
        <?= '<pre>'?>
    <p style="color:green"><?php print_r($forecast)?></p>
    <?= '</pre>' ?>
    </blockquote>

    <?php }?>

   


</div>