<?php
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../config/config.php');
class Database
{
        public $hostName   = DBHOST;
        public $dbName     = DBNAME;
        public $dbUser     = DBUSER;
        public $dbpassword = DBPASS;
        public $link;
        public $error;

        public  function __construct()
        {
            $this->connectDB();
        }

    public  function connectDB(){

        $this->link = new mysqli($this->hostName,$this->dbUser,$this->dbpassword,$this->dbName);
        if(!$this->link){

            $this->error = "connection fail".$this->link->connect_error;
            return false;

        }
    }

  public function select($query){

        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result-> num_rows > 0){

            return $result;
        }
        else{
            return false;
        }

    }

    public function insert($query){

        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($insert_row){
            return $insert_row;
        }
        else{
            
           return false;
        }

    }

    public function update($query){

        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row){
        return $update_row;
        }
        else{
            
            return false;
        }

    }

    public function delete($query){

        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($delete_row){

       return $delete_row;
        }
        else{
            
           return false;
        }

    }
}