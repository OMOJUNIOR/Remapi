<?php

namespace Omojunior\remapi;

use Ramsey\Uuid\Uuid;

trait Configuration
{
    protected $primaryKey = '2ae5d9a3c61345abaff15b3ed598f6c9';

    protected $apiKey = '36360e4efc564febb9b39e48ce079d33';

    protected $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSMjU2In0.eyJjbGllbnRJZCI6Ijg5ZmU5OWQ3LWUzNmUtNGQ1NS04MjFmLWU3YmI0NmQ0ODcyMyIsImV4cGlyZXMiOiIyMDIyLTA4LTI5VDE2OjAwOjIyLjI5MCIsInNlc3Npb25JZCI6ImI4ZDNiZTk4LThmZWEtNDNhNy1hNTk4LTY4MDk5Y2VhYTZhYSJ9.TX3nUgXfGP8oC3KXbPzlV-4RJxKHPnvGjxFuaRbnapj-xGYs6_jFscflPc200ToqWpNo04L59vdr60JPbF3zfwazxq_jml843TfDS9EStu0vCZ4xc1lwhQ6P1A_tffoP4Vj9dUlfk15vLTxR9rEjsJdVu01eerkLZ4e5sSAPdNK0cTWZrIeiPX3UfvfO0GCxg4gSW3CbnK3INaRKOkNi6izaImnGCMw-fxSg3B0SYgl-BuxCAxtk_XRg6IdyfwV0Al_mFYspWFOoPjVbjCmCxxjgdV0SOMF1Ae2EK2h-CPCo-8yvu7KWEjsv573Y5lIUj05Pj1TIASuVPA0wjInVNA';

    protected $url;

    protected $referenceId = '4668b1d7-48ef-41fe-af86-99342aa67a57';

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
