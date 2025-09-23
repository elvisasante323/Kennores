<?php

class Forms
{
    public static function getLibraries(): void
    {
        includeCoreFiles(coreFiles() );
    }

    public static function getconfigs()
    {
        return require $_SERVER['DOCUMENT_ROOT']. "/Core/" . coreFiles()['config'];
    }

    public static function getResponseInstance(): JSONResponse
    {
        return new JSONResponse(200);
    }

    public static function getDbInstance($config): Database
    {
        return new Database($config);
    }

    public static function getErrorLoggerInstance($config): ErrorLogger
    {
        return new ErrorLogger($config);
    }

    public static function contactFormData(): array
    {
        return [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone'],
            "subject" => $_POST['subject'],
            "message" => $_POST['message']
        ];
    }

    public static function applicationFormData(): array
    {
        return [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone'],
            "filename" => $_FILES['file']['name'],
            "message" => $_POST['message']
        ];
    }

    public static function contactFormValidation($errorMessage): void
    {
        $data = Forms::contactFormData();
        $errorLogger = Forms::getErrorLoggerInstance(Forms::getconfigs());
        $response = Forms::getResponseInstance();

        // Initialize the validator and perform validation
        $validator = new Validation($data);

        $validator->validate("name", ["required", "minLength:3"]);
        $validator->validate("email", ["required", "email"]);
        $validator->validate("phone", ["required", "UKPhoneNumber", "minLength:10"]);
        $validator->validate("subject", ["required", "minLength:5"]);
        $validator->validate("message", ["required", "minLength:30"]);

        // Check for validation errors
        if ($validator->hasErrors()) {

            $errorLogger->logError($errorMessage);
            $response->setStatusCode(400);
            $response->send();
        }
    }

    public static function applicationFormValidation($errorMessage): void
    {
        $data = Forms::applicationFormData();
        $errorLogger = Forms::getErrorLoggerInstance(Forms::getconfigs());
        $response = Forms::getResponseInstance();

        // Initialize the validator and perform validation
        $validator = new Validation($data);

        $validator->validate("name", ["required", "minLength:3"]);
        $validator->validate("email", ["required", "email"]);
        $validator->validate("phone", ["required", "UKPhoneNumber", "minLength:10"]);
        $validator->validate("filename", ["required", "fileExtension:pdf"]);
        $validator->validate("message", ["required", "minLength:30"]);

        // Check for validation errors
        if ($validator->hasErrors()) {

            $errorLogger->logError($errorMessage);
            $response->setStatusCode(400);
            $response->send();
        }
    }

    public static function contactFormEmailBody($data): string
    {
        return "<h4>Contact Form Details</h4>
                <p>Name : <b>{$data['name']}</b></p>
                <p>Email : <b>{$data['email']}</b></p>
                <p>Phone : <b>{$data['phone']}</b></p>
                <p>Subject : <b>{$data['subject']}</b></p>
                <p>Message : <b>{$data['message']}</b></p>
                ";
    }

    public static function applicationFormEmailBody($data): string
    {
        return "<h4>Application Form Details</h4>
                <p>Name : <b>{$data['name']}</b></p>
                <p>Email : <b>{$data['email']}</b></p>
                <p>Phone : <b>{$data['phone']}</b></p>
                <p>CV : <b>Please check your attachments.</b></p>
                <p>Message : <b>{$data['message']}</b></p>
    ";
    }

}