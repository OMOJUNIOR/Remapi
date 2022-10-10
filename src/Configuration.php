<?php

namespace Omojunior\remapi;

use Ramsey\Uuid\Uuid;

trait Configuration
{
    protected $primaryKey = '';//Provide your primary key from your MTN account

    protected $apiKey = '';//Provide your API Key

    protected $accessToken = '';// Add the access token after generating the token

    protected $url;

    protected $referenceId = '';//Add the reference 

    protected $params;

    protected $headers;

    protected $authorization;

    protected $userPath = '/v1_0/apiuser/';

    protected $uuid;

    public function getBaseUrl()
    {
        $this->url = 'https://sandbox.momodeveloper.mtn.com';

        return $this->url;
    }

    protected function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    protected function getuuid()
    {
        $this->uuid = Uuid::uuid4()->toString();

        return  $this->uuid;
    }
}
