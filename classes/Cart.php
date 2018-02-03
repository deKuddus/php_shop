<?php
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../library/Database.php');
include_once ($filePath.'/../helper/Format.php');
?>


<?php

class Cart
{
    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $proID)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $proID = mysqli_real_escape_string($this->db->link, $proID);
        $sessionId = session_id();

        $squery = "SELECT * from product WHERE id = '$proID'";
        $result = $this->db->select($squery)->fetch_assoc();

        $productName = $result['name'];
        $price  = $result['price'];
        $image = $result['image'];
        $checkProduct = "select * from cart WHERE productId = '$proID' AND sessionId = '$sessionId'";
        $result = $this->db->select($checkProduct);
        if($result){
            $msg = "This Product already added to the cart";
            return $msg;
        }else{
        $query = "INSERT INTO   cart (sessionId,productId,productName,quantity,price,image) VALUES ('$sessionId', '$proID', '$productName', '$quantity', '$price', '$image')";
        $inserted_rows = $this->db->Insert($query);
        if($inserted_rows){
           header("location:cart.php");
        }
        else{
            header("location:404.php");
        }
    }
    }

    public function showCartProduct()
    {
       $sessionId = session_id();
       $query = "select * from cart WHERE sessionId = '$sessionId'";
       $result = $this->db->select($query);
       return $result;

    }

    public function updateToCart($cartId, $quantity)
    {
        $cartId= $this->fm->validation($cartId);
        $quantity= $this->fm->validation($quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $query = "UPDATE cart set quantity = '$quantity' WHERE id = '$cartId'";
        $updatecart = $this->db->update($query);

        if($updatecart){

            header('location:cart.php');
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>your cart not  updated.</span>";
            return  $message;
        }
    }

    public  function cartDelete($id)
    {
        $query = "DELETE from cart WHERE id = '$id'";
        $deletequery = $this->db->delete($query);
        if($deletequery){
            $message =  "<span style='color:green; font-size: 20px;'>Cart  Deleted.</span>";
            return  $message;
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>Cart   not Deleted.</span>";
            return  $message;
        }

    }
    public function checkCartBySession()
    {
        $sessionId = session_id();
        $query = "select * from cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteCartBySession()
    {
        $sessionId = session_id();
        $query = "delete from cart WHERE sessionId = '$sessionId'";
        return $this->db->delete($query);

    }

    public function getOrder($id)
    {
        $sessionId = session_id();
        $query = "select * from cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        if($result){
            while($data = $result->fetch_assoc()){

                $productId = $data['productId'];
                $productName = $data['productName'];
                $quantity = $data['quantity'];
                $price = $data['price'] * $quantity;
                $image = $data['image'];
                $insertQuery = "INSERT INTO order_table (customerId,productId,productName,quantity,price,image) VALUES ('$id', '$productId', '$productName', '$quantity', '$price', '$image')";
                $inserted_rows = $this->db->Insert($insertQuery);
                header("location:success.php");
            }
        }
    }



    public function payableAmount($customerID)
    {
        $query = "select price from order_table WHERE customerId = '$customerID' AND date = now()";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderList($id)
    {
        $query = "select * from order_table WHERE customerId = '$id' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderToAdmin()
    {
        $query = "select * from order_table ORDER BY date ASC ";
        $result = $this->db->select($query);
        return $result;
    }


    public function shiftUpdate( $customerid, $price, $date)
    {

         $customerid = $this->fm->validation($customerid);
         $price = $this->fm->validation($price);
         $date = $this->fm->validation($date);

        $customerid = mysqli_real_escape_string($this->db->link, $customerid);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);

         $query = "update order_table set
                     status = '1'
                     WHERE  customerId = '$customerid' AND price = '$price' AND date = '$date' ";
            $updateQuery = $this->db->update($query);
            if($updateQuery){
                $message =  "<span style='color:green; font-size: 20px;'>update Successfully.</span>";
                return $message;
            }
            else{
                $message =  "<span style='color:red; font-size: 20px;'>Not update .</span>";
                return $message;
            }
    }

    public function deleteShiftProduct( $customerid, $price, $date)
    {
         $customerid = $this->fm->validation($customerid);
         $price = $this->fm->validation($price);
         $date = $this->fm->validation($date);

        $customerid = mysqli_real_escape_string($this->db->link, $customerid);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);

        $query = "DELETE from order_table  WHERE  customerId = '$customerid' AND price = '$price' AND date = '$date' ";
        $deletequery = $this->db->delete($query);
        if($deletequery){
            $message =  "<span style='color:green; font-size: 20px;'>Data  Deleted.</span>";
            return  $message;
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>Data  not Deleted.</span>";
            return  $message;
        }


    }
    

    public function shiftConfirm( $customerid, $price, $date)
    {
         $customerid = $this->fm->validation($customerid);
         $price = $this->fm->validation($price);
         $date = $this->fm->validation($date);

        $customerid = mysqli_real_escape_string($this->db->link, $customerid);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);

         $query = "update order_table set
                     status = '2'
                     WHERE  customerId = '$customerid' AND price = '$price' AND date = '$date' ";
            $updateQuery = $this->db->update($query);
            if($updateQuery){
                $message =  "<span style='color:green; font-size: 20px;'>update Successfully.</span>";
                return $message;
            }
            else{
                $message =  "<span style='color:red; font-size: 20px;'>Not update .</span>";
                return $message;
            }
    }
}