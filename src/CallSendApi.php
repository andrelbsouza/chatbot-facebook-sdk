<?php
namespace ChatBot;


use GuzzleHttp\Client;

class CallSendApi
{
    const URL = 'https://graph.facebook.com/v2.6/me/messages';
    private $pageAccessToken;

    /**
     * CallSendApi constructor.
     * @param $pageAccessToken
     */
    public function __construct(string $pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;
    }

    public function make(array $message, string $url = null, $method = 'POST'){
        $client = new Client([
            'curl' => [
                CURLOPT_SSL_VERIFYPEER => false,
                ],
        ]);
        $url = $url ?? CallSendApi::URL;

        $response = $client->request($method, $url, [
            'json' => $message,
            'query'=> ['access_token' => $this->pageAccessToken]
        ]);

        return (string)$response->getBody();

    }


}