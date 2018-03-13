<?php
namespace App\Repositories;

use GuzzleHttp\Client;

class ApiRepository
{
    public function getIpLocation()
    {
        $client = new Client;

        $response = $client->request('GET', config('api.aliyunIpLocation.url'), [
            'headers' => [
                'Authorization' => 'APPCODE '.config('api.aliyunIpLocation.AppCode')
            ],
            'query' => [
                'ip' => \Request::getClientIp(),
            ]
        ]);

        return json_decode((string)$response->getBody(), true);
    }
}
