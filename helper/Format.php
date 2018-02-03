<?php

class Format
{
    public function dateFormat($date){
     return   date('F j, Y ,g:i a', strtotime($date));
    }

    public function textShort($text , $limit = 300){
        $text = $text."";
        $text = substr($text , 0 ,$limit);
        $text = substr($text , 0 ,strripos($text ,' '));
        $text = $text."....";
        return $text;
}

public  function validation($data){

        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;

}

public function title(){
    $path = $_SERVER['SCRIPT_NAME'];
    $title = basename($path , '.php');
    if($title == 'index'){
        $title = 'home';
    }elseif($title == 'contact'){
        $title = 'contact';
    }
    return $title = ucfirst($title);

}
}