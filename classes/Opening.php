<?php 

class Opening{

        // database connection and table name
        private $conn;
        private $table_name = "opening";
    
        // object properties
        public $id;
        public $title;
        public $article;
    
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, article=:article";
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->title   = htmlspecialchars(strip_tags($this->title));
        $this->article = htmlspecialchars(strip_tags($this->article));

        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":article", $this->article);

      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
      
    }

    // read products
    public function read(){
  
        // select all query
        $query = "SELECT * FROM " . $this->table_name ;
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

    // used when filling up the update product form
    function readOne(){
      
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? ";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        // set values to object properties
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->article = $row['article'];
    }

    // update the product
    function update(){
      
        // update query
        $query = "UPDATE ".$this->table_name." SET title =:title, article =:article WHERE id =:id ";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->id      = htmlspecialchars(strip_tags($this->id));
        $this->title   = htmlspecialchars(strip_tags($this->title)); 
        $this->article = htmlspecialchars(strip_tags($this->article));

        
        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':article', $this->article);

        // execute the query
        if($stmt->execute() ){
            return true;
            $stmt->errorInfo();
        }
        return false;
    }
    

    // delete the product
    function delete(){
      
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
      
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


}

?>