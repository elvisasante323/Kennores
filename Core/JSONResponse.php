<?php

class JSONResponse {

    private $statusCode;

    public function __construct(int $code) {
        $this->statusCode = $code;
    }

    private function getStatusMessages() {

        return [
            200 => "OK",
            201 => "Created",
            204 => "No Content",
            400 => "Bad Request",
            401 => "Unauthorized",
            404 => "Not Found",
            500 => "Internal Server Error"
        ];
    }

    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
    }

    public function send() {
        http_response_code($this->statusCode);
        header('Content-Type: application/json');
        echo json_encode($this->getStatusMessages()[$this->statusCode]);
        exit;
    }
}
