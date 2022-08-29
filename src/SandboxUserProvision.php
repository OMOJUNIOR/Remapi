<?php

namespace Omojunior\remapi;

require_once '../vendor/autoload.php';
use Omojunior\Remapi\Configuration;

class SandboxUserProvision
{
    use Configuration;

    // public $referenceId;

    public function __construct()
    {
        $this->referenceId = $this->getuuid();
    }

    public function createUser()
    {
        $this->referenceId = $this->getUuid();
        try {
            $this->headers = [
                'X-Reference-Id' => $this->referenceId,
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ];

            $this->params = json_encode([
                'providerCallbackHost' => 'https://webhook.site/a558be98-09f7-4169-8dab-de20eef8429d',
            ]);

            $client = new \GuzzleHttp\Client();

            $response = $client->post($this->getBaseUrl().'/v1_0/apiuser', ['headers' => $this->headers, 'body' => $this->params]);

            $data = $response->getStatusCode();
            $reference = $response->getBody();
        } catch (\Exception $e) {
            return 'Oops an error occurred while creating the api user :'.$e->getMessage();
        }

        return $data.' '.$this->referenceId;
    }

    public function getUser()
    {
        $url = $this->getBaseUrl();
        //$uuid = $this->getReferenceId();

        try {

            // $url .= $this->userPath;
            // $url .= $this->getReferenceId();

            $this->headers = [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ];

            $client = new \GuzzleHttp\Client();

            $response = $client->get($url.$this->userPath.$this->referenceId, ['headers' => $this->headers]);

            $data = $response->getStatusCode();
        } catch (\Exception $e) {
            return 'Oops an error occurred while getting  the api user :'.$e->getMessage();
        }

        return $data;
    }

    public function createApikey()
    {
        try {
            $url = $this->getBaseUrl();
            $url .= '/v1_0/apiuser/'.$this->referenceId .= '/apikey';
            $this->headers = [

                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ];

            $client = new \GuzzleHttp\Client();

            $response = $client->post($url, ['headers' => $this->headers]);

            $datas = json_decode($response->getBody(), true);
            foreach ($datas as $value) {
                $data = $value;
            }
        } catch (\Exception $e) {
            return 'Oops an error occurred while creating the apikey :'.$e->getMessage();
        }

        return $data;
    }
}

$creat = new SandboxUserProvision();

//print_r($creat->getReferenceId());

echo "\n";

$db = $creat->createUser();

print_r($db);
echo "\n";

echo $db = $creat->getUser();

echo "\n";

echo $db = $creat->createApikey();

//print_r($creat->getReferenceId());

//print_r($creat->createUser());

//print_r($creat->getUser());

//print_r($creat->createApikey());

//apikey 50cc47e01f76465cb6c1c8cea2bad424//
