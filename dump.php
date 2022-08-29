<?php

namespace Omojunior\remapi\SandboxUserProvision;

require '../vendor/autoload.php';
use GuzzleHttp\Psr7\Request;
use Omojunior\remapi\config\Configuration;

class SandboxUserProvision
{
    //use Configuration;
    protected $primaryKey;  //'Ocp-Apim-Subscription-Key'

    public $params;

    protected $url;

    public $headers;

    protected $apiKey;

    protected $referenceId;

    /*
     public function __construct(){

         $this->primaryKey = "2ae5d9a3c61345abaff15b3ed598f6c9";
         $this->referenceId =$referenceId;
         $this->params = [];
         $this->url = "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser";
         $this->headers = [];
     }
     */

    public function __construct()
    {
        $url = 'https://www.uuidtools.com/api/generate/v4';

        if ($url) {
            $data = file_get_contents($url);

            $uuid = json_decode($data);
            foreach ($uuid as $key) {
                $this->referenceId = $key;
            }

            $this->primaryKey = '2ae5d9a3c61345abaff15b3ed598f6c9';
        } else {
            echo 'error in generating uuid v4';
        }
    }

    public function getReferenceId()
    {
        return $this->referenceId;
    }

    public function createUser()
    {
        $this->url = 'https://sandbox.momodeveloper.mtn.com/v1_0/apiuser';

        try {
            $this->headers = [
                'X-Reference-Id' => $this->getReferenceId(),
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ];

            $this->params = json_encode([
                'providerCallbackHost' => 'https://webhook.site/a558be98-09f7-4169-8dab-de20eef8429d',
            ]);

            $client = new \GuzzleHttp\Client();

            $response = $client->post($this->url, ['headers' => $this->headers, 'body' => $this->params]);

            $data = $response->getStatusCode();
        } catch (\Exception $e) {
            return 'Oops an error occurred while creating the api user :'.$e->getMessage();
        }

        return $data;
    }

    public function getUser()
    {
        try {
            $this->url .= '/'.$this->referenceId;

            $this->headers = [

                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ];

            $client = new \GuzzleHttp\Client();

            $response = $client->get($this->url, ['headers' => $this->headers]);

            $data = $response->getStatusCode();
        } catch (\Exception $e) {
            return 'Oops an error occurred while getting  the api user :'.$e->getMessage();
        }

        return $data;
    }

    public function createApikey()
    {
        try {
            $this->url .= '/'.$this->referenceId .= '/apikey';

            $this->headers = [

                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ];

            $client = new \GuzzleHttp\Client();

            $response = $client->post($this->url, ['headers' => $this->headers]);

            //$data=$response->getStatusCode();
            $data = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Oops an error occurred while creating the apikey :'.$e->getMessage();
        }

        return $data;
    }
}

$creat = new SandboxUserProvision();
echo $db = $creat->createUser();

//print_r($creat->createUser());

//print_r($creat->getUser());

//print_r($creat->createApikey());

//apikey 50cc47e01f76465cb6c1c8cea2bad424//

//Token list here is

class Token
{
    use Configuration;

    protected $clientKey;

    protected $authorization;

    //protected $referenceId;
    protected $primaryKey;

    protected $headers;

    public $url;

    public $tokenInput;

    public $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSMjU2In0.eyJjbGllbnRJZCI6ImQyNzg5Yjg3LWE1NTEtNGI1Yy05NjZiLWViNjJhMTYzMWM2MyIsImV4cGlyZXMiOiIyMDIyLTA4LTE4VDE0OjAwOjQ2Ljg3MiIsInNlc3Npb25JZCI6IjI3YTExNmNhLTFmNjUtNDJlNy1hNzk0LTdlNzFhMzFhMjUyMiJ9.V944_uPNbM3M6mLhgqnXOv-NHopu5cnAqMtlvcx7dXLcLFM1Y98SpG6nPpwE7cA_6nai7R5qJdk5cFSK1CwYO6Myofrfxy6F3O9sWKhteIGBiQtyolLC7W9tq35stbiYTslYNN4C-cW76xD37cFfEmPw-ZJ5anwRynB5BCDkA7jaqjU21qSO7uiwvk79xnx2ItIoeWNpc2pOiYOMT7rH4Xg6oC93JcMHrYMNXLr1ABL9BsQETiGcKBgZ3QPxioDbr1ruQh-Hiv_pMmd-MBuRA2J8lAecbJeOvr2mD-MaQ3Wz2v8KpZfIVbzAR4xtLj7FPHTY-q8JYLH5r0scg4cQFg';

    public $param;

    public $userNumber = '0886564945';

    public $notifyUsers;

    public function accessToken()
    {
        try {
            $head = [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'Authorization' => 'Bearer '.$this->accessToken,
                'X-Target-Environment' => 'sandbox',
            ];

            return $head;
        } catch (\Exception $e) {
            return 'Oops Access token method missing key information'.$e->getMessage().':'.$e->getLine();
        }
    }

    public function createToken($tokenInput)
    {
        $this->apiKey = '50cc47e01f76465cb6c1c8cea2bad424';
        $this->primaryKey = '2ae5d9a3c61345abaff15b3ed598f6c9';
        $this->referenceId = 'd6e62bfd-c843-45a0-8377-828a2e87ddd8';

        $this->authorization = ['Basic'.base64_encode($this->referenceId.':'.$this->apiKey)];

        $this->headers = ['Ocp-Apim-Subscription-Key' => $this->primaryKey, 'Authorization' => 'Basic'.base64_encode("$this->referenceId".':'."$this->apiKey")];

        $url = 'https://sandbox.momodeveloper.mtn.com';

        $headers = [
            'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            'Authorization' => 'Bearer '.$this->accessToken,
            'X-Reference-Id' => $this->referenceId,
            'X-Target-Environment' => 'sandbox',
        ];

        try {
            switch ($tokenInput) {

                // Token generation is needed for transactions which will automatically be renewed

                case  'Token':
                    $url .= '/remittance/token/';
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' => ['Ocp-Apim-Subscription-Key' => $this->primaryKey,
                            'Authorization' => 'Basic '.base64_encode($this->referenceId.':'.$this->apiKey),
                        ],
                        'json' => [
                            'grant_type' => 'client_credentials',
                        ],
                    ]);

                    $data = json_decode($response->getBody(), true);

                    break;

                    // Request to pay notification Message

                case  'Request to pay':

                    $this->notifyUsers = ["Transaction is on it's way"];

                    $url .= "/remittance/v1_0/requesttopay/$this->referenceId/deliverynotification";
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' => ['Ocp-Apim-Subscription-Key' => $this->primaryKey,
                            'Authorization' => 'Basic '.base64_encode($this->referenceId.':'.$this->apiKey),
                            'notificationMessage' => $this->notifyUsers, ],
                        ['body' => $this->notifyUsers,
                        ],

                    ]);

                    $data = $response->getStatusCode();
                    $data .= json_decode($response->getBody(), true);

                    // Users checking account balance

                case  'Balance':

                    $url .= '/remittance/v1_0/account/balance';

                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('get', $url, ['headers' => $headers]);

                    $data = json_decode($response->getBody(), true);
                    break;

                    // Checking users details

                case   'User details':

                    $url .= "/remittance/v1_0/accountholder/msisdn/$this->userNumber/basicuserinfo";
                    $client = new \GuzzleHttp\Client(['headers' => $headers]);
                    $response = $client->request('get', $url);
                    $data = json_decode($response->getBody(), true);
                    break;

                    //Users initiating new transfer request

                case  'Transfer':

                    $url .= '/remittance/v1_0/transfer';

                    $externalId = '00123';
                    $amount = '65.00';
                    $currency = 'EUR';
                    $payerMessage = 'Hi Michell this is the final test transfer from Omo Junior';
                    $payeeNote = 'This api is currently under development';
                    $accountHolderIdType = 'MSISDN';
                    $partyId = $this->userNumber;

                    $client = new \GuzzleHttp\Client(['headers' => $headers]);
                    $response = $client->request('POST', $url, ['body' => json_encode(
                        [
                            'amount' => $amount,
                            'currency' => $currency,
                            'externalId' => $externalId,
                            'payee' => [
                                'partyIdType' => $accountHolderIdType,
                                'partyId' => $partyId,
                            ],
                            'payerMessage' => $payerMessage,
                            'payeeNote' => $payeeNote,
                        ]
                    )]);

                    $data = 'Transaction was successfully created'.$response->getStatusCode();
                    break;

                    //Checking transfer status by ussers;

                case  'Transfer Status':

                    $url .= "/remittance/v1_0/transfer/$this->referenceId";
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('get', $url, [
                        'headers' => ['Ocp-Apim-Subscription-Key' => $this->primaryKey,
                            'Authorization' => 'Bearer '.$this->accessToken,
                            'X-Target-Environment' => 'sandbox',
                        ],
                    ]);
                    $data = json_decode($response->getBody(), true);
                    break;

                default:
                    $data = 'Invalid value provided';

            }
        } catch (\Exception $e) {
            return '<div style=color:red;text-align:> Oops Error in generating token for remittance api'.$e->getMessage().'</div>';
        }

        return $data;
    }
}

$token = new Token();

$userdetails = $token->createToken('Transfer Status');
echo '<pre>';
print_r($userdetails);
echo '</pre>';





// Today trash codes are




public function createToken($tokenInput)
{

    // $this->headers = ['Ocp-Apim-Subscription-Key' => $this->primaryKey,'Authorization' => 'Basic'.base64_encode("$this->referenceId".':'."$this->referenceId")];

 

    try {
        switch ($tokenInput) {

                // Request to pay notification Message

            case  'Request to pay':

                $this->notifyUsers = ["Transaction is on it's way"];

                $url .= "/remittance/v1_0/requesttopay/$this->referenceId/deliverynotification";
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $url, [
                    'headers' => ['Ocp-Apim-Subscription-Key' => $this->primaryKey,
                        'Authorization' => 'Basic '.base64_encode($this->referenceId.':'.$this->apiKey),
                        'notificationMessage' => $this->notifyUsers, ],
                    ['body' => $this->notifyUsers,
                    ],

                ]);

                $data = $response->getStatusCode();
                $data .= json_decode($response->getBody(), true);

                break;

                // Users checking account balance

            case  'Balance':

                $url .= '/remittance/v1_0/account/balance';

                $this->headers = [
                    'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                    'Authorization' => 'Bearer '.$this->accessToken,
                    'X-Reference-Id' => $this->referenceId,
                    'X-Target-Environment' => 'sandbox',
                ];

                $client = new \GuzzleHttp\Client();

                $response = $client->request('get', $url, ['headers' => $this->headers]);

                $data = json_decode($response->getBody(), true);
                break;

                // Checking users details

            case   'User details':

                $url .= "/remittance/v1_0/accountholder/msisdn/$this->userNumber/basicuserinfo";
                $client = new \GuzzleHttp\Client(['headers' => $headers]);
                $response = $client->request('get', $url);
                $data = json_decode($response->getBody(), true);
                break;

                //Users initiating new transfer request

            case  'Transfer':

                $url .= '/remittance/v1_0/transfer';

                $externalId = '00123';
                $amount = '65.00';
                $currency = 'EUR';
                $payerMessage = 'Hi Michell this is the final test transfer from Omo Junior';
                $payeeNote = 'This api is currently under development';
                $accountHolderIdType = 'MSISDN';
                $partyId = $this->userNumber;

                $client = new \GuzzleHttp\Client(['headers' => $headers]);
                $response = $client->request('POST', $url, ['body' => json_encode(
                [
                    'amount' => $amount,
                    'currency' => $currency,
                    'externalId' => $externalId,
                    'payee' => [
                        'partyIdType' => $accountHolderIdType,
                        'partyId' => $partyId,
                    ],
                    'payerMessage' => $payerMessage,
                    'payeeNote' => $payeeNote,
                ]
                )]);

                $data = 'Transaction was successfully created'.$response->getStatusCode();
                break;

                //Checking transfer status by ussers;

            case  'Transfer Status':

                $url .= "/remittance/v1_0/transfer/$this->referenceId";
                $client = new \GuzzleHttp\Client();
                $response = $client->request('get', $url, [
                    'headers' => ['Ocp-Apim-Subscription-Key' => $this->primaryKey,
                        'Authorization' => 'Bearer '.$this->accessToken,
                        'X-Target-Environment' => 'sandbox',
                    ],
                ]);
                $data = json_decode($response->getBody(), true);
                break;

            default:
                $data = 'Invalid value provided';

        }
    } catch (\Exception $e) {
        return '<div style=color:red;text-align:> Oops Error in generating token for remittance api'.$e->getMessage().'</div>';
    }

    return $data;
}




public function getToken()
{
    $headers = ['headers' => [
        'Ocp-Apim-Subscription-Key' => $this->primaryKey,
        'Authorization' => 'basic'.base64_encode("$this->referenceId".':'."$this->apiKey"),
        'json' => [

            'grant_type' => 'client_credentials',
        ],
    ]];

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', $this->getBaseUrl().'/remittance/token/', $headers);

    return   $data = json_decode($response->getBody(), true);
}