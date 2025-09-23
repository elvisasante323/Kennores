<?php

class ApiClient {
    private $baseUrl;
    private $headers;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
        $this->headers = [];
    }

    public function setHeader($name, $value) {
        $this->headers[] = "$name: $value";
    }

    public function get($endpoint, $queryParams = []) {
        $url = $this->buildUrl($endpoint, $queryParams);

        return $this->makeRequest($url, 'GET');
    }

    public function post($endpoint, $data = []) {
        $url = $this->buildUrl($endpoint);

        return $this->makeRequest($url, 'POST', $data);
    }

    public function put($endpoint, $data = []) {
        $url = $this->buildUrl($endpoint);

        return $this->makeRequest($url, 'PUT', $data);
    }

    public function delete($endpoint) {
        $url = $this->buildUrl($endpoint);

        return $this->makeRequest($url, 'DELETE');
    }

    private function buildUrl($endpoint, $queryParams = []) {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');

        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }

        return $url;
    }

    private function makeRequest($url, $method, $data = []) {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);

        if ($method === 'POST' || $method === 'PUT') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $this->setHeader('Content-Type', 'application/json');
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false) {
            return false; // Request failed
        }

        curl_close($curl);

        return [
            'status' => $httpCode,
            'data' => json_decode($response, true),
        ];
    }
}
