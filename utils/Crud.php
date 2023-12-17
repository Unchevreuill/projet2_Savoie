 <?php

// class Crud
// {
//     private $connexion;

//     public function __construct()
//     {
//         $host = "localhost";
//         $db = "tp_1";
//         $user = "root";
//         $password = "";

//         $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

//         try {
//             $this->connexion = new PDO($dsn, $user, $password);
//             if (!$this->connexion) {
//                 throw new Exception("Failed to connect to the database.");
//             }
//         } catch (PDOException $e) {
//             throw new Exception("Database connection error: " . $e->getMessage());
//         }
//     }

//     public function getAll(string $table): array
//     {
//         $PDOStatement = $this->connexion->query("SELECT * FROM $table ORDER BY id ASC");
//         return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public function getById(string $table, int $id): array
//     {
//         $PDOStatement = $this->connexion->prepare("SELECT * FROM $table WHERE id = :id");
//         $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
//         $PDOStatement->execute();
//         return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public function add(string $request, array $itemdata): int
//     {
//         $PDOStatement = $this->connexion->prepare($request);

//         foreach ($itemdata as $key => $value) {
//             $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
//             $PDOStatement->bindValue(':' . $key, $value, $type);
//         }

//         $PDOStatement->execute();

//         if ($PDOStatement->rowCount() <= 0) {
//             throw new Exception("Failed to add the item.");
//         }

//         return $this->connexion->lastInsertId();
//     }

//     public function delete(string $table, int $id): string
//     {
//         $element = $this->getById($table, $id);

//         if (!$element) {
//             throw new Exception("Element not found.");
//         }

//         $PDOStatement = $this->connexion->prepare("DELETE FROM $table WHERE id = :id");
//         $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
//         $PDOStatement->execute();

//         return "The element with id $id has been deleted.";
//     }

//     public function __destruct()
//     {
//         $this->connexion = null;
//     }
// }
