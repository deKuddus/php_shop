<?php
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../library/Database.php');
include_once ($filePath.'/../helper/Format.php');
?>

<?php

class Frontsiteclass
{
    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

}