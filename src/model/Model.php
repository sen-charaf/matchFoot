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
}
