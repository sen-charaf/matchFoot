<?php
require_once __DIR__ . '/../database/connectDB.php';

class Model
{
    use DbConnection;

    protected static $table;  // Define table name in child classes



    public static function getAll(): array
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->query("SELECT * FROM " . static::$table);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return [];
            }
            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function getById($id): array
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $result =$stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return [];
            }
            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function exists($data):bool
    {
        try {
            $pdo = self::connect();
            $whereClause = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($data)));
            $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE $whereClause");
            $stmt->execute($data);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? true : false;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function create($data): int
    {
        try {
            $pdo = self::connect();
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $stmt = $pdo->prepare("INSERT INTO " . static::$table . " ($columns) VALUES ($values)");
            $stmt->execute($data);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function update($id, $data): bool
    {
        try {
            $pdo = self::connect();
            $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
            $stmt = $pdo->prepare("UPDATE " . static::$table . " SET $setClause WHERE id = :id");
            $data['id'] = $id;
            return $stmt->execute($data);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function delete($id): bool
    {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw $e;
        }
    }

  
        public static function validate($data, $rules): bool|array{
            $errors = [];
    
            foreach ($rules as $field => $ruleSet) {
                $value = $data[$field] ?? null;
                $ruleList = explode('|', $ruleSet); 
    
                foreach ($ruleList as $rule) {
                    if ($rule === 'required' && empty($value)) {
                        $errors[$field] = "$field is required.";
                    } elseif ($rule === 'numeric' && !is_numeric($value)) {
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
                    }   elseif (strpos($rule, 'unique:') === 0) {
                        $field = explode(':', $rule)[1];
                        $exists = static::exists([$field => $value]);
                        if ($exists) {
                            $errors[$field] = "$field already exists.";
                        }
                    } elseif ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$field] = "$field must be a valid email address.";
                }   elseif ($rule === 'date' && !strtotime($value)) {
                    $errors[$field] = "$field must be a valid date.";
                }elseif (strpos($rule, 'date_format:') === 0) {
                    $format = explode(':', $rule)[1];
                    $d = DateTime::createFromFormat($format, $value);
                    if (!$d || $d->format($format) !== $value) {
                        $errors[$field] = "$field must be a valid date in format $format.";
                    }
                }
            }
    
            return empty($errors) ? true : $errors;
        }

        return empty($errors) ? true : $errors;
    
    
}
}
