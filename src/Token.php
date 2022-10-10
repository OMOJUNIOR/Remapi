<?php

namespace Omojunior\remapi\Token;

require_once '../vendor/autoload.php';
use Omojunior\Remapi\Configuration;
use Ramsey\Uuid\Uuid;

class Remittance 
{
    use Configuration;

    public function getToken()
    {
        try {
            $this->headers = [
                'headers' => ['Ocp-Apim-Subscription-Key' => $this->primaryKey,
                    'Authorization' => 'Basic '.base64_encode("$this->referenceId".':'."$this->apiKey"),
                ],
                'json' => [
                    'grant_type' => 'client_credentials',
                ],
            ];

            $client = new \GuzzleHttp\Client($this->headers);
            $response = $client->post($this->getBaseUrl().'/remittance/token/');

            $data = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Oops an error occurred while getting new token'.' '.$e->getMessage().' '.$e->getCode();
        }

        return $data;
    }

    public function getBalance()
    {
        try {
            $this->headers = [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'Authorization' => 'Bearer '.$this->accessToken,
                'X-Reference-Id' => $this->referenceId,
                'X-Target-Environment' => 'sandbox',
            ];

            $client = new \GuzzleHttp\Client();

            $response = $client->get($this->getBaseUrl().'/remittance/v1_0/account/balance', ['headers' => $this->headers]);

            $data = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Oops an error occurred while checking account balance'.PHP_EOL.$e->getMessage().''.$e->getLine();
        }

        return $data;
    }

    public function getUserInfo(int $userNumber)
    {
        try {
            $this->headers = [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'Authorization' => 'Bearer '.$this->accessToken,
                'X-Reference-Id' => $this->referenceId,
                'X-Target-Environment' => 'sandbox',
            ];

            $userUrlPath = "/remittance/v1_0/accountholder/msisdn/$userNumber/basicuserinfo";
            $client = new \GuzzleHttp\Client(['headers' => $this->headers]);

            $response = $client->request('get', $this->getBaseUrl().$userUrlPath);
            $data = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Oops an error occurred while fetching userdetails'.PHP_EOL.$e->getMessage().' '.$e->getLine();
        }

        return $data;
    }

    public function transferFund($partyId, $amount, $payerMessage = '', $payeeNote = '')
    {
        try {
            $transactionId = Uuid::uuid4()->toString();
            $this->headers = [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'Authorization' => 'Bearer '.$this->accessToken,
                'X-Reference-Id' => $transactionId,
                'X-Target-Environment' => 'sandbox',
            ];

            $transferPath = '/remittance/v1_0/transfer';

            $client = new \GuzzleHttp\Client(['headers' => $this->headers]);
            $response = $client->post($this->getBaseUrl().$transferPath, ['body' => json_encode(
                [
                    'amount' => $amount,
                    'currency' => 'EUR',
                    'externalId' => $transactionId,
                    'payee' => [
                        'partyIdType' => 'MSISDN',
                        'partyId' => $partyId,
                    ],
                    'payerMessage' => $payerMessage,
                    'payeeNote' => $payeeNote,
                ]
            )]);

            $data = 'Transaction was successfully created'.$transactionId;
        } catch (\Exception $e) {
            return 'Oops an error occurred while creating a tranfer request'.PHP_EOL.$e->getMessage().' '.$e->getLine();
        }

        return $data;
    }

    public function transferStatus()
    {
        try {
            $this->headers = [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'Authorization' => 'Bearer '.$this->accessToken,
                'X-Reference-Id' => $this->referenceId,
                'X-Target-Environment' => 'sandbox',
            ];

            $statusPath = "/remittance/v1_0/transfer/$this->referenceId";
            $client = new \GuzzleHttp\Client(['headers' => $this->headers]);
            $response = $client->get($this->getBaseUrl().$statusPath);

            $data = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Oops an error occurred while getting transaction status'.PHP_EOL.$e->getMessage().' '.$e->getLine();
        }

        return $data;
    }
}

