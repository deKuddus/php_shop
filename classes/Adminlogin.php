<?php

    $filePath = realpath(dirname(__FILE__));
    include ($filePath.'/../library/Session.php');
    Session::checkLogin();
    include ($filePath.'/../library/Database.php');
    include ($filePath.'/../helper/Format.php');



class Adminlogin
{
    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLogin($username,$userpass)
    {
        $username = $this->fm->validation($username);
        $userpass = $this->fm->validation($userpass);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $userpass = mysqli_real_escape_string($this->db->link, $userpass);
        if($userpass == "" OR $username == ""){

            $message =  "<span style='color:red; font-size: 20px;'>User Name or Password must not empty</span>";
            return  $message;
        }else{

            $query = "select * from admin where username = '$username' AND password = '$userpass'";
            $userdata = $this->db->select($query);
            if($userdata != false){
                $value = $userdata->fetch_assoc();
                Session::set("Login", true);
                Session::set("userid", $value['id']);
                Session::set("name", $value['name']);
                Session::set("username", $value['username']);
                header("Location:index.php");
                }else{
                $message =  "<span style='color:red; font-size: 20px;'>User Name or Password does not match</span>";
                return  $message;


            }
        }


    }

}