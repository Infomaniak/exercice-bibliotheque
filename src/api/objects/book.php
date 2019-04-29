<?php
class Book{
 
    private $conn;
    private $table_name = "Books";
 
    public $id;
    public $titre;
    public $auteur;
    public $genre;
    public $type;
    public $date;
    public $dispo;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        // create query
        $query = "SELECT 
                    B_ID AS 'id',
                    B_Titre AS 'titre', 
                    B_Auteur AS 'auteur',
                    B_Genre AS 'genre', 
                    B_Type AS 'type', 
                    B_Date AS 'date' ,
                    B_Dispo AS 'dispo'
                FROM 
                    " . $this->table_name;
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function readOne(){
        // query to read single book
        $query = "SELECT
                    B_Titre AS 'titre', 
                    B_Auteur AS 'auteur',
                    B_Genre AS 'genre', 
                    B_Type AS 'type', 
                    B_Date AS 'date',
                    B_Dispo AS 'dispo'
                FROM
                    " . $this->table_name . "
                WHERE
                    B_ID = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of book to be updated
        $stmt->bindParam(1, $this->id);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->titre = $row['titre'];
        $this->auteur = $row['auteur'];
        $this->genre = $row['genre'];
        $this->type = $row['type'];
        $this->date = $row['date'];
        $this->dispo = $row['dispo'];
    }

    function readOneWithUser(){
        // query to read single book
        $query = "SELECT
                    B_Titre AS 'titre', 
                    B_Auteur AS 'auteur',
                    B_Genre AS 'genre', 
                    B_Type AS 'type', 
                    B_Date AS 'date',
                    B_Dispo AS 'dispo',
                    U_Username AS 'username'
                FROM
                    " . $this->table_name . "
                    LEFT JOIN Borrow ON Books.B_ID = Borrow.B_ID
                    LEFT JOIN Users ON Users.U_ID = Borrow.U_ID
                WHERE
                    Books.B_ID = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of book to be updated
        $stmt->bindParam(1, $this->id);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->titre = $row['titre'];
        $this->auteur = $row['auteur'];
        $this->genre = $row['genre'];
        $this->type = $row['type'];
        $this->date = $row['date'];
        $this->dispo = $row['dispo'];

        return $row['username'];
    }

    function readBorrowed($idUser) {
        // create query
        $query = "SELECT 
                    Books.B_ID AS 'id',
                    B_Titre AS 'titre', 
                    B_Auteur AS 'auteur',
                    B_Genre AS 'genre', 
                    B_Type AS 'type', 
                    B_Date AS 'date' ,
                    B_Dispo AS 'dispo'
                FROM 
                    " . $this->table_name ."
                    INNER JOIN Borrow ON Books.B_ID = Borrow.B_ID
                WHERE
                    Borrow.U_ID = :idUser";
     
        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind value
        $stmt->bindParam(':idUser', $idUser);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function create(){
        // query to insert book
        $query = "INSERT INTO Books (B_Titre, B_Auteur, B_Genre, B_Type, B_Date, B_Dispo)
                VALUES (:titre, :auteur, :genre, :type, :date, :dispo)";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->auteur = htmlspecialchars(strip_tags($this->auteur));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->dispo = htmlspecialchars(strip_tags($this->dispo));
        
     
        // bind values
        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":auteur", $this->auteur);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":dispo", $this->dispo);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;    
    }

    function update(){
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    B_Titre = :titre, 
                    B_Auteur = :auteur, 
                    B_Genre = :genre, 
                    B_Type = :type, 
                    B_Date = :date, 
                    B_Dispo = :dispo
                WHERE
                    B_ID = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->auteur = htmlspecialchars(strip_tags($this->auteur));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->dispo = htmlspecialchars(strip_tags($this->dispo));
        $this->id = htmlspecialchars(strip_tags($this->id));
     
        // bind values
        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":auteur", $this->auteur);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":dispo", $this->dispo);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    function borrow($idUser) {
        $queryUpdate = "UPDATE Books
                        SET 
                            B_Dispo = 0
                        WHERE
                            Books.B_ID = :idBook";
        
        $queryInsert = "INSERT INTO Borrow (B_ID, U_ID) VALUES (:idBook, :idUser)";

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $idUser = htmlspecialchars(strip_tags($idUser));
     
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare($queryUpdate);
            $stmt->bindParam(':idBook', $this->id);
            $res = $stmt->execute();

            if($res == false){
                $this->conn->rollback();
                return false;
            }
            
            $stmt = $this->conn->prepare($queryInsert);
            $stmt->bindParam(':idBook', $this->id);
            $stmt->bindParam(':idUser', $idUser);
            $res = $stmt->execute();

            if($res == false){
                $this->conn->rollback();
                return false;
            }

            $res = $this->conn->commit();
     
            return $res;
        }
        catch (Exception $e) {
            return false;
        }
    }

    function returnBook($idUser) {
        $queryUpdate = "UPDATE Books
                        SET 
                            B_Dispo = 1
                        WHERE
                            Books.B_ID = :idBook";
        
        $queryRemove = "DELETE FROM Borrow 
                        WHERE 
                            B_ID = :idBook 
                        AND U_ID = :idUser";

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $idUser = htmlspecialchars(strip_tags($idUser));
     
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare($queryUpdate);
            $stmt->bindParam(':idBook', $this->id);
            $res = $stmt->execute();

            if($res == false){
                $this->conn->rollback();
                return false;
            }
            
            $stmt = $this->conn->prepare($queryRemove);
            $stmt->bindParam(':idBook', $this->id);
            $stmt->bindParam(':idUser', $idUser);
            $res = $stmt->execute();

            if($res == false){
                $this->conn->rollback();
                return false;
            }

            $res = $this->conn->commit();
     
            return $res;
        }
        catch (Exception $e) {
            return false;
        }

    }

    function delete(){
        try {
            $this->conn->beginTransaction();

            $query = "DELETE FROM Borrow WHERE B_ID = :id";
        
            $stmt = $this->conn->prepare($query);
            
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);
            $res = $stmt->execute();

            if($res == false){
                $this->conn->rollback();
                return false;
            }
    
            $query = "DELETE FROM " . $this->table_name . " WHERE B_ID = :id";
        
            $stmt = $this->conn->prepare($query);
        
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);
            $err = $stmt->execute();

            if($res == false){
                $this->conn->rollback();
                return false;
            }

            $res = $this->conn->commit();
            
            return $res;
        }
        catch (Exception $e) {
            return false;
        }    
    }

    function search($keywords){
        // select all query
        $query = "SELECT
                    B_Titre AS 'titre', 
                    B_Auteur AS 'auteur',
                    B_Genre AS 'genre', 
                    B_Type AS 'type', 
                    B_Date AS 'date',
                    B_Dispo AS 'dispo'
                FROM
                    " . $this->table_name . "
                WHERE
                    B_Titre LIKE ? OR
                    B_Auteur LIKE ? OR
                    B_Genre LIKE ? OR
                    B_Type LIKE ? OR
                    B_Date LIKE ?";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
     
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
        $stmt->bindParam(5, $keywords);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total_rows'];
    }

    public function readPaging($from_record_num, $records_per_page){
        // select query
        $query = "SELECT
                    B_Titre AS 'titre', 
                    B_Auteur AS 'auteur',
                    B_Genre AS 'genre', 
                    B_Type AS 'type', 
                    B_Date AS 'date',
                    B_Dispo AS 'dispo'
                FROM
                    " . $this->table_name . "
                LIMIT ?, ?";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
     
        // execute query
        $stmt->execute();
     
        // return values from database
        return $stmt;
    }
}