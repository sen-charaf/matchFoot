<?php
require_once __DIR__ . '/../model/Model.php';

class Controller {


    public static function validate($data, $rules): bool|array
    {
        $errors = [];

        foreach ($rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;
            $ruleList = explode('|', $ruleSet);
            
            
            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $errors[$field] = "$field is required.";
                    return $errors;
                } elseif ($rule === 'numeric' && !empty($value) && !is_numeric($value)) {
                    $errors[$field] = "$field must be a number.";
                } elseif (strpos($rule, 'min:') === 0) {
                    $min = explode(':', $rule)[1];
                    if (strlen($value) < $min) {
                        $errors[$field] = "$field must be at least $min characters.";
                    }
                } elseif (strpos($rule, 'max:') === 0) {
                    $max = explode(':', $rule)[1];
                    
                    if (strlen($value) > $max) {
                        $errors[$field] = "$field must not exceed $max characters.";
                    }
                } elseif ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "$field must be a valid email address.";
                } elseif ($rule === 'date' && !strtotime($value)) {
                    $errors[$field] = "$field must be a valid date.";
                } elseif (strpos($rule, 'date_format:') === 0) {
                    $format = explode(':', $rule)[1];
                    $d = DateTime::createFromFormat($format, $value);
                    if (!$d || $d->format($format) !== $value) {
                        $errors[$field] = "$field must be a valid date in format $format.";
                    }
                } elseif ($rule === 'unique' && Model::exists([$field => $value])) {
                    $errors[$field] = "$field already exists.";
                } elseif (strpos($rule,'in:') === 0) {
                    $options = explode(',', explode(':', $rule)[1]);
                    if (!in_array($value, $options)) {
                        $errors[$field] = "$field must be one of " . implode(', ', $options);
                    }
                }
            }

        }

        return empty($errors) ? true : $errors;
    }
}