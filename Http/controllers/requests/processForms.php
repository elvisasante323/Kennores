<?php

require $_SERVER['DOCUMENT_ROOT'] . "/Http/controllers/requests/Forms.php";

// Required classes and configuration
Forms::getLibraries();
$config = Forms::getconfigs();

// Instances of classes
$response = Forms::getResponseInstance();
//$db = Forms::getDbInstance($config);
//$errorLogger = Forms::getErrorLoggerInstance($config);

if ($_SERVER['REQUEST_URI'] === "/join") {

    // Gather data from $_POST variable
    $data = Forms::applicationFormData();

    // Initialize the validator and perform validation
    Forms::applicationFormValidation("Application form validation failure");

    // Insert data into the database
//    $db->create("applications", $data);

    // Prepare email body
    $data['emailBody'] = Forms::applicationFormEmailBody($data);

    // Send email
    $data['path'] = $_FILES['file']['tmp_name'];
    $data['original_path'] = $_FILES['file']['name'];
    $data['subject'] = "New Application";
} else {

    // Gather data from $_POST variable
    $data = Forms::contactFormData();


    // Initialize the validator and perform validation
    Forms::contactFormValidation("Contact form validation fails");

    // Insert data into the database
//    $db->create("contacts", $data);

    // Prepare email body
    $data['emailBody'] = Forms::contactFormEmailBody($data);

}

sendEmail($data, $config);
var_dump('here');
exit();
// Send a success response
$response->setStatusCode(200);
$response->send();

