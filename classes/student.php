<?php 
class Student{

    // variables decleration
    public $stud_id;
    public $name;
    public $email;
    public $mobile;

    private $conn;
    private $table_name;

    //constractor

    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name="student_tbl";
    }
    // Insert student data
    public function creat_data(){

        //sql query to insert data
        $query = "INSERT INTO ".$this->table_name." SET name=? , email=? , mobile=?";

        //prepare the sql
        $obj = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));

        $obj->bind_param("sss", $this->name, $this->email, $this->mobile);

        if($obj->execute()){
            return true;
        }
            return false;
    }
    // get all students data
    public function get_all_data(){

        $sql_query = "SELECT * from ".$this->table_name;
    
        $sql_obj = $this->conn->prepare($sql_query);
    
        $sql_obj->execute();
    
        return $sql_obj->get_result();
    
      }

    // get single student data
    public function get_stud_data(){

        $msql_query = "SELECT * from ".$this->table_name." WHERE stud_id = ?";
    
        $msql_obj = $this->conn->prepare($msql_query);
    
        $msql_obj->bind_param("i", $this->stud_id);
    
        $msql_obj->execute();
    
        $data= $msql_obj->get_result();

        return $data->fetch_assoc();
    
      }
    // update student information
    public function update_data(){

        //sql query to update data
        $update_query = " UPDATE ".$this->table_name." SET name=? , email=? , mobile=? WHERE stud_id=?";

        //prepare the sql
        $update_obj = $this->conn->prepare($update_query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->stud_id=htmlspecialchars(strip_tags($this->stud_id));

        $update_obj->bind_param("sssi", $this->name, $this->email, $this->mobile , $this->stud_id );

        if($update_obj->execute()){
            return true;
        }
            return false;
    }
    //delete student
    public function delete_student(){

        //sql query to update data
        $delete_query = " DELETE from ".$this->table_name." WHERE stud_id=?";

        //prepare the sql
        $delete_obj = $this->conn->prepare($delete_query);

        $this->stud_id=htmlspecialchars(strip_tags($this->stud_id));

        $delete_obj->bind_param("i",$this->stud_id );

        if($delete_obj->execute()){
            return true;
        }else{
            return false;
        }
    }

} 
// $std= new Student((new Database())->connect());
// $std->creat_data();

?>