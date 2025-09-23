<?php
require "vendor/autoload.php";

use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\PHPMailer;

/**
 *  Dumping variable values
 *
 * @param $value
 * @return void
 */
function dd($value) : void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

/**
 * @param string $path
 * @param array $data
 * @return void
 */
function view(string $path, array $data = []) : void
{
    extract($data);
    require "views/" . $path;
}

/**
 * @param array $user
 * @return void
 */
function login(array $user) : void
{
    $_SESSION['user'] = ['email' => $user['email']];
    session_regenerate_id(true);
}

/**
 * @return void
 */
function logout() : void
{
    $_SESSION = [];
    $params = session_get_cookie_params();

    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    header('Location: /');
    exit();
}

/**
 * @param array $data
 * @param array $config
 * @return void
 */
function sendEmail(array $data, array $config): void
{
    // Google credentials
//    getGoogleCredentials($config);

    // instantiate mailer
    $mail = new PHPMailer(true);

    // Mailer Configurations
    getMailerConfig($mail, $config, $data);

    // Attachments
    attachFilesToEmail($mail, $data);

    // Email construction
    constructEmail($mail, $config, $data);
}

/**
 * @param array $config
 * @return void
 */
function getGoogleCredentials(array $config) : void
{

    new Google([
        'clientId' => $config["CLIENT_ID"],
        'clientSecret' => $config["CLIENT_SECRET"],
        'redirectUri' => $config["REDIRECT_URI"]
    ]);
}


/**
 * @param object $mail
 * @param array $config
 * @param array $data
 * @return void
 */
function getMailerConfig(object $mail, array $config, array $data) : void
{
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = $config["SMTP_USER"];
    $mail->Password = $config["SMTP_PASSWORD"] ;
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    $mail->isHTML(true);

    // Sender information
    $mail->setFrom($data['email'], $data['subject']);

    // Receiver information
    $mail->addAddress($config["RECEIPIENT"], $config["RECEIPIENT_NAME"]);
}

/**
 * @param object $mail
 * @param array $data
 * @return void
 */
function attachFilesToEmail(object $mail, array $data) : void
{
    if (array_key_exists("path", $data)) {
        $mail->addAttachment($data['path'], $data['original_path']);
    }
}

/**
 * @param object $mail
 * @param array $config
 * @param array $data
 * @return void
 */
function constructEmail(object $mail, array $config, array $data) : void
{
    $err = new ErrorLogger($config);
    $json = new JSONResponse(500);

    $mail->Subject = $data['subject'];
    $mail->Body = $data['emailBody'];

    // Send email
    if (!$mail->send()) {
        $err->logError("Email function: Unable to send email.");
        $json->send();
    }

    // Close connection
    $mail->smtpClose();
}

/**
 * @param array $filesToInclude
 * @return void
 */
function includeCoreFiles(array $filesToInclude) : void
{
    foreach ($filesToInclude as $file) {
        require $_SERVER['DOCUMENT_ROOT'] . "/Core/" . $file;
    }
}

/**
 * @return string[]
 */
function coreFiles() : array
{
    return [
        "json" => "JSONResponse.php",
        "validation" => "Validation.php",
        "errorLogger" => "ErrorLogger.php",
        "db" => "Database.php",
        "config" => "config.php",
    ];
}