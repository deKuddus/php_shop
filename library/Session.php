<?php


class Session
{
    public  static  function sessioninit(){
      session_start();

    }
    public  static function set($key,$value){

        $_SESSION[$key] = $value;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        else{
            return false;
        }
    }
    public static function checkSession(){
        self::sessioninit();
        if(self::get("Login") == false){
           self::sessionDestroy();
        }
    }

    public static function checkLogin(){
        self::sessioninit();
        if(self::get("Login") == true){
            header("Location:index.php");
        }
    }

    public static function sessionDestroy(){

        session_destroy();
        header("Location:login.php");
    }
}