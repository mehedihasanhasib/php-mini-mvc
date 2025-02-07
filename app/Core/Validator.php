<?php

namespace App\Core;

class Validator
{
    protected static $errors = [];

    public static function make($data, $rules)
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (is_callable($rule)) {
                    $rule($data[$field], $field, function ($message) use ($field) {
                        self::$errors[$field][] = $message;
                    });
                } elseif (is_object($rule)) {
                    $rule->validate($data[$field], $field, function ($message) use ($field) {
                        self::$errors[$field][] = $message;
                    });
                } else {
                    switch ($rule) {
                        case 'required':
                            if (empty($data[$field])) {
                                self::$errors[$field][] = "The $field field is required.";
                            }
                            break;
                        case "string";
                            if (!is_string($data[$field])) {
                                self::$errors[$field][] = "The $field field must be a string.";
                            }
                            break;
                        case "email";
                            if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                                self::$errors[$field][] = "The $field field must be a valid email.";
                            }
                            break;

                        case str_starts_with($rule, 'max:'):
                            $maxLength = (int) substr($rule, 4);
                            if (strlen($data[$field]) > $maxLength) {
                                self::$errors[$field][] = "The $field field must not exceed $maxLength characters.";
                            }
                            break;
                        case str_starts_with($rule, 'digits:'):
                            $maxLength = (int) substr($rule, 7);
                            if (!is_numeric($data[$field]) || strlen($data[$field]) > $maxLength) {
                                self::$errors[$field][] = "The $field field must not exceed $maxLength digits.";
                            }
                            break;

                        case "numeric":
                            if (!is_numeric($data[$field])) {
                                self::$errors[$field][] = "The $field field must be numeric.";
                            }
                            break;

                        case str_starts_with($rule, 'min:'):
                            $minLength = (int) substr($rule, 4);
                            if (strlen($data[$field]) < $minLength) {
                                self::$errors[$field][] = "The $field field must be at least $minLength characters.";
                            }
                            break;
                        case str_starts_with($rule, 'confirm:');
                            $targetField = substr($rule, 8); // Extract the field to confirm
                            if ($data[$targetField] !== $data[$field]) {
                                self::$errors[$field][] = "The $field doesn't match the $targetField.";
                            }
                            break;
                        case str_starts_with($rule, 'unique:');
                            list($table, $column) = explode(',', substr($rule, 7));
                            $result = Database::query("SELECT id FROM $table WHERE $column = ?", [$data[$field]]);
                            if (!empty($result)) {
                                self::$errors[$field][] = "The $field already exists.";
                            }
                            break;

                        case 'image':
                            if (array_key_exists($field, $data) && !is_string($data[$field])) {
                                $image = @imagecreatefromstring(file_get_contents($data[$field]['tmp_name'] ?: "null"));
                                if ($image === false) {
                                    self::$errors[$field][] = "Invalid image file.";
                                }
                            }
                            break;
                        case str_starts_with($rule, 'size:'):
                            if (array_key_exists($field, $data) && !is_string($data[$field])) {
                                $maxSize = (int) substr($rule, 5) * 1024; // Convert KB to Bytes
                                if (($data[$field]['size'] ?? 0) > $maxSize) {
                                    $mb = $maxSize / 1024 / 1024;
                                    self::$errors[$field][] = "The $field field must not exceed {$mb} MB.";
                                }
                            }
                            break;
                        case str_starts_with($rule, 'mimes:'):
                            if (array_key_exists($field, $data) && !is_string($data[$field])) {
                                $allowedMimes = explode(',', substr($rule, 6));
                                $fileMime = mime_content_type($data[$field]['tmp_name'] ?? 'null');
                                if (!in_array(substr($fileMime, 6), $allowedMimes)) {
                                    self::$errors[$field][] = "The $field field must be one of the following types: " . implode(', ', $allowedMimes) . ".";
                                }
                            }
                            break;
                        case str_starts_with($rule, 'exists:'):
                            list($table, $column) = explode(',', substr($rule, 7));
                            $result = Database::query("SELECT id FROM $table WHERE $column = ?", [$data[$field]]);
                            if (empty($result)) {
                                self::$errors[$field][] = "Invalid $field.";
                            }
                            break;
                    }
                }
            }
        }
        return new self();
    }

    public function fails()
    {
        return !empty(self::$errors);
    }

    public function errors()
    {
        return self::$errors;
    }
}
