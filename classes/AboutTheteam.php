<?php 
class AboutTheTeam{

    // variables decleration
    public $about_the_team;
    public $team_vision;
    public $team_messege;
    public $id;
    public $year;
    public $description;

    private $conn;
    private $about_the_team_table;
    private $date_of_team_table;

    //constractor

    public function __construct($db)
    {
        $this->conn = $db;
        $this->about_the_team_table="about_the_team";
        $this->date_of_team_table ="date_of_team";
    }
    // get all 3n_elfaric data
    public function get_about_the_team_data(){

        $sql_query = "SELECT * from ".$this->about_the_team_table;
    
        $sql_obj = $this->conn->prepare($sql_query);
    
        $sql_obj->execute();
    
        return $sql_obj->get_result();
    
      }


    // update 3n_elfaric information
    public function update_about_the_team_data(){

        //sql query to update data
        $update_query = " UPDATE ".$this->about_the_team_table." SET about_the_team=? , team_vision=? , team_messege=? ";

        //prepare the sql
        $update_obj = $this->conn->prepare($update_query);

        $this->about_the_team=htmlspecialchars(strip_tags($this->about_the_team));
        $this->team_vision=htmlspecialchars(strip_tags($this->team_vision));
        $this->team_messege=htmlspecialchars(strip_tags($this->team_messege));

        $update_obj->bind_param("sss", $this->about_the_team, $this->team_vision, $this->team_messege);

        if($update_obj->execute()){
            return true;
        }
            return false;
    }
    // Insert tarekh_elfaric data
    public function creat_date_of_team(){

        //sql query to insert data
        $query = "INSERT INTO ".$this->date_of_team_table." SET year=? , description=? ";

        //prepare the sql
        $obj = $this->conn->prepare($query);

        $this->year=htmlspecialchars(strip_tags($this->year));
        $this->description=htmlspecialchars(strip_tags($this->description));

        $obj->bind_param("ss", $this->year, $this->description);

        if($obj->execute()){
            return true;
        }
            return false;
    }
      // get all tarekh_elfaric data
      public function get_date_of_team_data(){

        $sql_query = "SELECT * from ".$this->date_of_team_table;
    
        $sql_obj = $this->conn->prepare($sql_query);
    
        $sql_obj->execute();
    
        return $sql_obj->get_result();
    
      }
      // update tarekh_elfaric information
      public function update_date_of_team(){

        //sql query to update data
        $update_query = " UPDATE ".$this->date_of_team_table." SET year=? , description=?  WHERE id=?";

        //prepare the sql
        $update_obj = $this->conn->prepare($update_query);

        $this->year=htmlspecialchars(strip_tags($this->year));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $update_obj->bind_param("ssi", $this->year, $this->description,  $this->id );

        if($update_obj->execute()){
            return true;
        }
            return false;
    }
    //delete tarekh_elfaric
    public function delete_date_of_team(){

        //sql query to update data
        $delete_query = " DELETE from ".$this->date_of_team_table." WHERE id=?";

        //prepare the sql
        $delete_obj = $this->conn->prepare($delete_query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $delete_obj->bind_param("i",$this->id );

        if($delete_obj->execute()){
            return true;
        }else{
            return false;
        }
    }


 } 


?>