<?php
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../library/Database.php');
include_once ($filePath.'/../helper/Format.php');
?>

<?php


class Customer
{
    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data)
    {
        $Name = $this->fm->validation($data['name']);
        $city = $this->fm->validation($data['city']);
        $zip = $this->fm->validation($data['zip']);
        $email = $this->fm->validation($data['email']);
        $address = $this->fm->validation($data['address']);
        $country = $this->fm->validation($data['country']);
        $phone = $this->fm->validation($data['phone']);
        $password = $this->fm->validation($data['password']);

        $Name = mysqli_real_escape_string($this->db->link, $Name);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $password = mysqli_real_escape_string($this->db->link, md5($password));

        if($Name == "" OR $city == "" OR $zip == "" OR $email == "" OR $address == "" OR $country == "" OR $phone == "" OR $password == ""){

            $message =  "<span style='color:red; font-size: 20px;'>Input field must not empty.</span>";
            return  $message;
        }

        $query = "select * from customer WHERE email = '$email' limit  1";
        $resutl = $this->db->select($query);
        if($resutl){
            $message =  "<span style='color:red; font-size: 20px;'>This Email already exist.</span>";
            return  $message;
        }else{
            $query = "INSERT INTO  customer (name,email,city,zip,address,country,phone,password) VALUES ('$Name', '$email', '$city', '$zip', '$address', '$country','$phone','$password')";
            $inserted_rows = $this->db->Insert($query);
            if($inserted_rows){
                $message =  "<span style='color:green; font-size: 20px;'>user Data inserted Successfully.</span>";
                return $message;
            }
            else{
                $message =  "<span style='color:red; font-size: 20px;'>user Data Not inserted.</span>";
                return $message;
            }
        }
    }

    public function customerLogin($data)
    {
        $email = $this->fm->validation($data['customerEmail']);
        $password = $this->fm->validation(md5($data['password']));

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if($email == "" OR $password == ""){
            $message =  "<span style='color:red; font-size: 20px;'>Input field must not empty.</span>";
            return  $message;
        }
        $query = "select * from customer WHERE email = '$email' AND password = '$password'";
        $result = $this->db->select($query);
        if($result){
            $data = $result->fetch_assoc();
            Session::set("customerLogin" , "true");
            Session::set("id", $data['id']);
            Session::set("name", $data['name']);
            header("location:order.php");
        }else{
            $message =  "<span style='color:red; font-size: 20px;'>Email or Password does not match.</span>";
            return  $message;
        }


    }

    public  function getCustomerProfile($id)
    {
        $query = "select * from customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function  customerprofileUpdate($data ,$id)
    {
        $Name = $this->fm->validation($data['name']);
        $city = $this->fm->validation($data['city']);
        $zip = $this->fm->validation($data['zip']);
        $email = $this->fm->validation($data['email']);
        $address = $this->fm->validation($data['address']);
        $country = $this->fm->validation($data['country']);
        $phone = $this->fm->validation($data['phone']);

        $Name = mysqli_real_escape_string($this->db->link, $Name);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone = mysqli_real_escape_string($this->db->link, $phone);


        if($Name == "" OR $city == "" OR $zip == "" OR $email == "" OR $address == "" OR $country == "" OR $phone == ""){

            $message =  "<span style='color:red; font-size: 20px;'>Input field must not empty.</span>";
            return  $message;
        }else{
            $query = "update customer set
                     name = '$Name',
                     city = '$city',
                     zip = '$zip',
                     email = '$email',
                     address = '$address',
                     country = '$country',
                     phone = '$phone' WHERE  id = '$id'";
            $updateQuery = $this->db->update($query);
            if($updateQuery){
                $message =  "<span style='color:green; font-size: 20px;'>your profile update Successfully.</span>";
                return $message;
            }
            else{
                $message =  "<span style='color:red; font-size: 20px;'>your profile update .</span>";
                return $message;
            }
        }
    }

   public function customerMessage($data)
   {
         $name = $this->fm->validation($data['name']);
         $email = $this->fm->validation($data['email']);
         $phone = $this->fm->validation($data['phone']);
         $message = $this->fm->validation($data['message']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $message = mysqli_real_escape_string($this->db->link, $message);

        if($name == "" OR $email == "" OR $phone == "" OR $message == ""){

            $message =  "<span style='color:red; font-size: 20px;'>Input field must not empty.</span>";
            return  $message;
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $message =  "<span style='color:red; font-size: 20px;'>Invalid Email Address.</span>";
            return  $message;
        }else{
            $query = "INSERT INTO  contact (name,email,phone,message) VALUES ('$name', '$email', '$phone', '$message')";
            $inserted_rows = $this->db->Insert($query);
            if($inserted_rows){
                $message =  "<span style='color:green; font-size: 20px;'>your message sended Successfully.</span>";
                return $message;
            }
            else{
                $message =  "<span style='color:red; font-size: 20px;'>your message not sended .</span>";
                return $message;
            }
        }



   }

}