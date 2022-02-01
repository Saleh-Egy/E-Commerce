<?php


use Illuminate\Support\Facades\App;
use GuzzleHttp\Client;


if (! function_exists('send_request')) {
    function send_request($route, $method, $headers = [], $body = []) {
       
        $client = new Client();
        $data = [];
        $returnedData = '';
        $headers += [
            "Accept" => "application/json",
            "content-type" => "application/json"
        ];
        $data['headers'] = $headers;
        $url = $route;
        $response = $client->request($method, $url, [
            'body' => json_encode($body, JSON_PRESERVE_ZERO_FRACTION),
            'headers' => $headers
        ]);
        $response = json_decode($response->getBody(), true);
        return $response;
    }
}

