<?php

$url = 'https://www.uuidtools.com/api/generate/v4';

if ($url) {
    $data = file_get_contents($url);

    $uuid = json_decode($data);
    foreach ($uuid as $key) {
        echo $key;
    }
} else {
    echo 'error in generating uuid v4';
}
