<?php
namespace App\utils;



use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Google {


    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 2.0,
            'verify' => 'cacert.pem'
        ]);
    }


    public function token($endpoint, $code) {
        try {
            $response = $this->client->request('POST', $endpoint, [
                'form_params' => [
                    'code' => $code,
                    'client_id' => env('GOOGLE_ID'),
                    'client_secret' => env('GOOGLE_SECRET'),
                    'redirect_uri' => 'http://localhost:8000/connect',
                    'grant_type' => 'authorization_code'

                ]
            ]);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return json_decode((string)$response->getBody())->access_token;
    }

    public function userinfo($endpoint, $token) {
        try {
            $response = $this->client->request('GET', $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,

                ]
            ]);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }

        return json_decode($response->getBody());
    }





    public  function endpoint($return) {
        $response = $this->client->request('GET', "https://accounts.google.com/.well-known/openid-configuration");
        switch($return) {
            case 'token' : return json_decode((string)$response->getBody())->token_endpoint;
            case 'userinfo' : return json_decode((string)$response->getBody())->userinfo_endpoint;
        }


    }

    public static  function url_connection() {
        $url_redrect = env('APP_URL').'/connect';

        $google_id = env('GOOGLE_ID');
        return "https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&response_type=code&redirect_uri=$url_redrect&client_id=$google_id";

    }
}
