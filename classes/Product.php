<?php
$filePath = realpath(dirname(__FILE__));
include_once ($filePath.'/../library/Database.php');
include_once ($filePath.'/../helper/Format.php');
?>




<?php


class Product
{
    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertProduct($data, $files)
    {

        $productName = $this->fm->validation($data['name']);
        $catId = $this->fm->validation($data['catId']);
        $brandId = $this->fm->validation($data['brandID']);
        $productBody = $this->fm->validation($data['body']);
        $productPrice = $this->fm->validation($data['price']);
        $productType = $this->fm->validation($data['type']);

        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        $productBody = mysqli_real_escape_string($this->db->link, $productBody);
        $productPrice = mysqli_real_escape_string($this->db->link, $productPrice);
        $productType = mysqli_real_escape_string($this->db->link, $productType);

        $permitted = array('jpg' , 'jpeg' , 'png' , 'gif');
        $file_Name = $files['image']['name'];
        $file_Size = $files['image']['size'];
        $file_Temp = $files['image']['tmp_name'];

        $div = explode('.',$file_Name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0 ,10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if($productName == "" OR $catId == "" OR $brandId == "" OR $productBody == "" OR $productPrice == "" OR $productType == "" OR $file_Name == ""){

            $message =  "<span style='color:red; font-size: 20px;'>Input field must not empty.</span>";
            return  $message;
        } elseif($file_Size > 2048567){
            $message =  "<span style='color:red; font-size: 20px;'>ERROR!! Image should be less than 2MB.</span>";

            return  $message;
        } elseif (in_array($file_ext , $permitted) === false){
            $message = "<span style='color:red; font-size: 20px;'>you can upload only :-".implode(',' , $permitted)."</span>";
            return $message;
        }else{
            move_uploaded_file($file_Temp ,$uploaded_image);
            $query = "INSERT INTO   product (name,catId,brandId,body,price,image,type) VALUES ('$productName', '$catId', '$brandId', '$productBody', '$productPrice', '$uploaded_image','$productType')";
            $inserted_rows = $this->db->Insert($query);
            if($inserted_rows){
                $message =  "<span style='color:green; font-size: 20px;'>Product inserted Successfully.</span>";
                return $message;
            }
            else{
                $message =  "<span style='color:red; font-size: 20px;'>Product Not inserted.</span>";
                return $message;
            }
        }
    }

    ////////////////////////////
    /// two method retrive category and brand for inserting product
    //////////////////////////

    public function categoryList()
    {
        $query = "select * from category ORDER  BY id DESC ";
        $selectCat = $this->db->select($query);
        return $selectCat;
    }


    public function brandyList()
    {
        $query = "select * from brand ORDER  BY id DESC ";
        $selectBrand = $this->db->select($query);
        return $selectBrand;
    }
    ////////////////////////////////////////////////
    ///////////////////////////////////////////



    public function getProductAll()
    {
        $query = "select p.*,c.cat_name,b.brand_name
         from product as p,category as c, brand as b
         WHERE p.catId = c.id AND p.brandId = b.id
         ORDER BY p.id DESC";
//        $query = "SELECT  product.*, category.cat_name,brand.brand_name
//         from product
//         INNER JOIN category
//         ON product.catId = category.id
//         INNER JOIN brand
//         ON product.brandId = brand.id
//         ORDER BY product.id DESC";
        $result = $this->db->select($query);
        return $result;
    }


    public function deleteProduct($delID)
    {
        $selectQuery = "select * from product WHERE id = '$delID'";
        $getProduct = $this->db->select($selectQuery);
        if($getProduct){
            while($value = $getProduct->fetch_assoc()){
                $unlinkImage = $value['image'];
                unlink($unlinkImage);
            }
        }
        $delQuery = "delete from product WHERE  id = '$delID'";
        $deleteProduct = $this->db->delete($delQuery);
        if($deleteProduct){
            $message =  "<span style='color:green; font-size: 20px;'>product has Deleted successfully.</span>";
            return  $message;
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>product has  not Deleted.</span>";
            return  $message;
        }
    }


    public function updatetProduct($data, $files,$id)
    {

        $productName = $this->fm->validation($data['name']);
        $catId = $this->fm->validation($data['catId']);
        $brandId = $this->fm->validation($data['brandID']);
        $productBody = $this->fm->validation($data['body']);
        $productPrice = $this->fm->validation($data['price']);
        $productType = $this->fm->validation($data['type']);

        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        $productBody = mysqli_real_escape_string($this->db->link, $productBody);
        $productPrice = mysqli_real_escape_string($this->db->link, $productPrice);
        $productType = mysqli_real_escape_string($this->db->link, $productType);

        $permitted = array('jpg' , 'jpeg' , 'png' , 'gif');
        $file_Name = $files['image']['name'];
        $file_Size = $files['image']['size'];
        $file_Temp = $files['image']['tmp_name'];

        $div = explode('.',$file_Name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0 ,10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if($productName == "" OR $catId == "" OR $brandId == "" OR $productBody == "" OR $productPrice == "" OR $productType == ""){

            $message =  "<span style='color:red; font-size: 20px;'>Input field must not empty.</span>";
            return  $message;
        }else {
            if($file_Name !== "") {
                if ($file_Size > 2048567) {
                    $message = "<span style='color:red; font-size: 20px;'>ERROR!! Image should be less than 2MB.</span>";

                    return $message;
                } elseif (in_array($file_ext, $permitted) === false) {
                    $message = "<span style='color:red; font-size: 20px;'>you can upload only :-" . implode(',', $permitted) . "</span>";
                    return $message;
                } else {
                    move_uploaded_file($file_Temp, $uploaded_image);
                    $query = "UPDATE product SET
                        name = '$productName',
                        catId = '$catId',
                        brandId = '$brandId',
                        body = '$productBody',
                        price = '$productPrice',
                        image = '$uploaded_image',
                        type = '$productType'
                        WHERE id = '$id'";
                    $update_rows = $this->db->update($query);
                    if ($update_rows) {
                        $message = "<span style='color:green; font-size: 20px;'>Product updated Successfully.</span>";
                        return $message;
                    } else {
                        $message = "<span style='color:red; font-size: 20px;'>Product Not updated.</span>";
                        return $message;
                    }
                }
            }else{
                $query = "UPDATE product SET
                        name = '$productName',
                        catId = '$catId',
                        brandId = '$brandId',
                        body = '$productBody',
                        price = '$productPrice',
                        type = '$productType'
                        WHERE id = '$id'";
                $update_rows = $this->db->update($query);
                if ($update_rows) {
                    $message = "<span style='color:green; font-size: 20px;'>Product updated Successfully.</span>";
                    return $message;
                } else {
                    $message = "<span style='color:red; font-size: 20px;'>Product Not updated.</span>";
                    return $message;
                }

            }
        }

    }


    public function getAllProduct($productID)
    {
        $query = "select * from product WHERE id = '$productID'";
        $result = $this->db->select($query);
        return $result;
    }



    public function getFeaturedProduct()
    {
        $query = "select * from product WHERE type = '0' ORDER by id DESC  limit 4";
        $result = $this->db->select($query);
        return $result;

    }


    public function getNewProduct()
    {
        $query = "select * from product  ORDER by id DESC limit 4 ";
        $result = $this->db->select($query);
        return $result;
    }


    public function detailsOfProduct($id)
    {

        $query = "select p.*,c.cat_name,b.brand_name
         from product as p,category as c, brand as b
         WHERE p.catId = c.id AND p.brandId = b.id AND p.id = '$id'";

        $result = $this->db->select($query);
        return $result;
    }

    public function latestSamsungBrand()
    {
        $query = "select * from product WHERE id = '1' ORDER BY id  DESC  limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestAcerBrand()
    {
        $query = "select * from product WHERE id = '2' ORDER BY id DESC limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestCanonBrand()
    {
        $query = "select * from product WHERE id = '5' ORDER BY id  DESC limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestAppleBrand()
    {
        $query = "select * from product WHERE id = '4' ORDER BY id  DESC limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function  getProductByCatId($id)
    {
        $query = "select * from product WHERE catId = '$id' ORDER BY id  DESC limit 1";
        $result = $this->db->select($query);
        return $result;
    }


    public function insertCompareProduct($id ,$productID)
    {
         $customerId = $this->fm->validation($id);
         $productCompareId = $this->fm->validation($productID);

        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $productCompareId = mysqli_real_escape_string($this->db->link, $productCompareId);
        
        $Cquery = "SELECT * from compare WHERE customerId = '$customerId' AND productId = '$productCompareId'";
        $check = $this->db->select($Cquery);
        if($check){
             $message = "<span style='color:red; font-size: 20px;'>already added to compare.</span>";
                    return $message;
         }else{
            $query = "SELECT * from product WHERE id = '$productCompareId'";
            $result = $this->db->select($query)->fetch_assoc();
            if($result){
                $productId = $result['id'];
                $productName = $result['name'];
                $price = $result['price'];
                $image = $result['image'];
                $insertData = "INSERT INTO   compare (customerId,productId,productName,price,image) VALUES ('$customerId', '$productId', '$productName','$price', '$image')";
                $result = $this->db->insert($insertData);
                if($result){
                    $message = "<span style='color:green; font-size: 20px;'>Product  add to compare.</span>";
                        return $message;
                    }else{
                        $message = "<span style='color:green; font-size: 20px;'>Product Not add to compare.</span>";
                        return $message;

                }


            }

         }
    }

    public function showCompareProduct($id)
    {
        $query = "SELECT * FROM compare WHERE customerId = '$id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
         
    }

    public function deleteCompareData($id)
    {
         $delQuery = "delete from compare WHERE  customerId = '$id'";
        $deleteProduct = $this->db->delete($delQuery);
        return $deleteProduct;
    }


    public function insertWishListProduct($id ,$productID)
    {
        $customerId = $this->fm->validation($id);
         $productId = $this->fm->validation($productID);

        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        
        $Cquery = "SELECT * from wishList WHERE customerId = '$customerId' AND productId = '$productId'";
        $check = $this->db->select($Cquery);
        if($check){
             $message = "<span style='color:red; font-size: 20px;'>already added to Wish List.</span>";
                    return $message;
         }else{
            $query = "SELECT * from product WHERE id = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();
            if($result){
                $productId = $result['id'];
                $productName = $result['name'];
                $price = $result['price'];
                $image = $result['image'];
                $insertData = "INSERT INTO   wishList (customerId,productId,productName,price,image) VALUES ('$customerId', '$productId', '$productName','$price', '$image')";
                $result = $this->db->insert($insertData);
                if($result){
                    $message = "<span style='color:green; font-size: 20px;'>Product  add to Wish List.</span>";
                        return $message;
                    }else{
                        $message = "<span style='color:green; font-size: 20px;'>Product Not add to Wish List.</span>";
                        return $message;

                }


            }

         }
    }


    public function checkWishListProduct($id)
    {
        $query = "SELECT * FROM wishList WHERE customerId = '$id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }



    public function deleteWistlistData($customerID, $id)
    {
        $delQuery = "delete from wishList WHERE  productId = '$id' AND customerId = '$customerID'";
        $deleteProduct = $this->db->delete($delQuery);
        return $deleteProduct;
    }

}




