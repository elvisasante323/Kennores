<?php

class ErrorLogger {
    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbName;
    private $dbConnection;

    public function __construct($config) {
        $this->dbHost = $config['host'];
        $this->dbUser = $config['username'];
        $this->dbPassword = $config['password'];
        $this->dbName = $config['dbname'];
    }

    // Open a database connection
    private function openConnection() {
        $this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        if ($this->dbConnection->connect_error) {
            die('Connection failed: ' . $this->dbConnection->connect_error);
        }
    }

    // Close the database connection
    private function closeConnection() {
        if ($this->dbConnection) {
            $this->dbConnection->close();
        }
    }

    // Log an error message to the database table
    public function logError($errorMessage) {
        $this->openConnection();

        // Escape the error message to prevent SQL injection
        $errorMessage = $this->dbConnection->real_escape_string($errorMessage);

        $sql = "INSERT INTO error_log (error_message, created_at) VALUES ('$errorMessage', NOW())";

        if ($this->dbConnection->query($sql) === TRUE) {
            echo "Error logged successfully.";
        } else {
            echo "Error logging failed: " . $this->dbConnection->error;
        }

        $this->closeConnection();
    }
}
