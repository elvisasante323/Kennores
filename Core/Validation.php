<?php

class Validation
{
    private $data;
    private $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate($field, $rules)
    {
        $value = $this->data[$field];

        foreach ($rules as $rule) {
            $ruleName = $rule;
            $parameters = [];

            if (strpos($rule, ':') !== false) {
                [$ruleName, $parameters] = explode(':', $rule);
                $parameters = explode(',', $parameters);
            }

            $methodName = 'validate' . ucfirst($ruleName);
            if (method_exists($this, $methodName)) {
                $valid = $this->$methodName($field, $value, $parameters);
                if (!$valid) {
                    $this->addError($field, $ruleName, $parameters);
                }
            } else {
                die("Validation rule '$ruleName' does not exist.");
            }
        }
    }

    public function addError($field, $rule, $parameters = [])
    {
        $this->errors[$field][] = [
            'rule' => $rule,
            'parameters' => $parameters,
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    // Validation Rules

    private function validateRequired($field, $value)
    {
        return !empty($value);
    }

    private function validateMinLength($field, $value, $parameters)
    {
        $minLength = (int) $parameters[0];
        return strlen($value) >= $minLength;
    }

    private function validateMaxLength($field, $value, $parameters)
    {
        $maxLength = (int) $parameters[0];
        return strlen($value) <= $maxLength;
    }

    private function validateEmail($field, $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Validate UK phone number
    private function validateUKPhoneNumber($field, $value) {
        $value = str_replace(' ', '', $value); // Remove spaces

        if (empty($value) || preg_match('/^(\+44|0)\d{10}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateFileExtension($field, $value, $parameters)
    {
        // Check if the file exists
        if (file_exists($_FILES['file']['tmp_name'])) {
            $allowedExtensions = $parameters;
            $fileExtension = pathinfo($value, PATHINFO_EXTENSION);

            // Check if the file extension is in the list of allowed extensions
            return in_array($fileExtension, $allowedExtensions);
        }

        // If the file doesn't exist, consider it as a validation failure
        return false;
    }
}


