<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Weather
{
    public $api_url = 'https://weatherapi-com.p.rapidapi.com';

    public $user;

    public function __construct() {
        $this->user = [
            'X-RapidAPI-Key' => config('api.key'),
            'X-RapidAPI-Host' => config('api.host')
        ];
    }

    public function current(string $location) {
        return $this->getRequest('current', [ 'q' => $location ]);
    }

    public function forecast(string $location, int $days = 3, string $language = 'en') {
        return $this->getRequest('forecast', [
            'q' => $location,
            'days' => $days,
            'lang' => $language,
        ]);
    }

    public function history(string $location, string $day, string $language = 'en') {
        return $this->getRequest('forecast', [
            'q' => $location,
            'dt' => $day,
            'lang' => $language,
        ]);
    }

    public function sports(string $location) {
        return $this->getRequest('sports', [ 'q' => $location ]);
    }


    private function getRequest(string $endpoint, array $data = []) {
        $response = Http::withHeaders($this->user)->get("$this->api_url/$endpoint.json", $data);

        return json_decode($response->body());
    }
}
