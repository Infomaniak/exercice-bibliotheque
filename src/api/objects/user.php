<?php
class User {
 
    private $conn;
    private $table_name = "Users";

    public $id;
    public $username;
    public $password;
    public $prenom;
    public $nom;
    public $type;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function login() {
        // select query
        $query = "SELECT 
                    U_ID AS 'id',
                    U_Username AS 'username', 
                    U_Password AS 'password',
                    U_Prenom AS 'prenom',
                    U_Nom AS 'nom',
                    U_Type AS 'type'
                FROM 
                    " . $this->table_name . "
                WHERE
                    U_Username = :username AND
                    U_Password = SHA2(:password, 256)";
     
        // prepare query
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
     
        // execute query
        $stmt->execute();
        
        $num = $stmt->rowCount();

        if($num > 0) {
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set values to object properties
            $this->id = $row['id'];
            $this->prenom = $row['prenom'];
            $this->nom = $row['nom'];
            $this->type = $row['type'];

            return true;
        }
        
        return false;
    }

    function register() {
        // check for multiple account
        $query = "SELECT * FROM Users WHERE U_Username = :username";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->nom = htmlspecialchars(strip_tags($this->nom));

        // bind values
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();
        
        $num = $stmt->rowCount();

        if($num > 0) {
            return false;
        }

        // query
        $query = "INSERT INTO Users (U_Username, U_Password, U_Prenom, U_Nom, U_Type)
                VALUES (:username, SHA2(:password, 256), :prenom, :nom, :type)";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":type", $this->type);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    function update() {
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    U_Username = :username, 
                    U_Password = SHA2(:password, 256), 
                    U_Prenom = :prenom, 
                    U_Nom = :nom, 
                    U_Type = :type
                WHERE
                    U_ID = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->id = htmlspecialchars(strip_tags($this->id));
     
        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>