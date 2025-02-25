<?php
require_once __DIR__ . '/../database/connectDB.php';

class Club implements JsonSerializable
{

    use DbConnection;

    private static $table = 'equipes';

    private $id;
    private $name;
    private $nickname;
    private $logo;
    private $logo_path;
    private $trainer;
    private $stadium;
    private $founded_at;
    private $created_at;

    

    public function __construct($id, $name, $nickname, $founded_at, $created_at, $logo = null, $logo_path = null, $trainer = null, $stadium = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nickname = $nickname;
        $this->founded_at = $founded_at;
        $this->created_at = $created_at;
        $this->logo = $logo;
        $this->logo_path = $logo_path;
        $this->trainer = $trainer;
        $this->stadium = $stadium;
    }

    public static function getAllClubs()
    {
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table`");
            $stmt->execute();
            $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clubs;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getClubDataById($id)
    {
        try {
            $table = self::$table;
            $pdo = self::connect();
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $clubData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $clubData;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function  create($name, $nickname, $logo_path, $trainer_id, $stad_id, $founded_at, $created_at)
    {
        try {
            
            $pdo = self::connect();
            $table = self::$table;

            // Prepare the SQL query
            $stmt = $pdo->prepare("
                INSERT INTO `$table` (nom, nickname, logo_path, entraineur_id, stad_id, founded_at, created_at) 
                VALUES (:name, :nickname, :logo_path, :trainer_id, :stad_id, :founded_at, :created_at)
            ");

            $stmt->execute([
                'name' => $name,
                'nickname' => $nickname,
                'logo_path' => $logo_path,
                'trainer_id' => $trainer_id,
                'stad_id' => $stad_id,
                'founded_at' => $founded_at,
                'created_at' => $created_at
            ]);

            $id = $pdo->lastInsertId();


            $club = new Club($id, $name, $nickname, $founded_at, $created_at, null, $logo_path, null, null);
           
            return $club;
        } catch (PDOException $th) {
            
            throw $th;
            return;
        }
    }

    public static function update($id, $name, $nickname, $logo_path, $trainer_id, $stad_id, $founded_at, $created_at)
    {
        try {
            $pdo = self::connect();
            $table = self::$table;
    
            $stmt = $pdo->prepare("
                UPDATE `$table` 
                SET nom = :name, nickname = :nickname, logo_path = :logo_path, entraineur_id = :trainer_id, stad_id = :stad_id, founded_at = :founded_at, created_at = :created_at 
                WHERE id = :id
            ");
    
            $stmt->execute([
                'name' => $name,
                'nickname' => $nickname,
                'logo_path' => $logo_path,
                'trainer_id' => $trainer_id,
                'stad_id' => $stad_id,
                'founded_at' => $founded_at,
                'created_at' => $created_at,
                'id' => $id
            ]);
    
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw $e;
            return;
        }
    }

    public static function delete($id) {
        try {
            $pdo = self::connect();
            $table = self::$table;
    
            $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = :id");
            $stmt->execute(['id' => $id]);
    
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw $e;
            return;
        }
    }
    



    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'logo_path' => $this->logo_path,
            'logo' => $this->logo,
            'trainer' => $this->trainer,
            'staduim' => $this->stadium,
            'founded_at' => $this->founded_at,
            'created_at' => $this->created_at
        ];
    }



    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getLogoPath()
    {
        return $this->logo_path;
    }

    public function getTrainer()
    {
        return $this->trainer;
    }

    public function getStadium()
    {
        return $this->stadium;
    }

    public function getFoundedAt()
    {
        return $this->founded_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
}
