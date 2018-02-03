<?php
$filePath = realpath(dirname(__FILE__));
include ($filePath.'/../library/Database.php');
include ($filePath.'/../helper/Format.php');
?>



<?php


class Brand
{

    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName)
    {

        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if($brandName == ""){
            $message =  "<span style='color:red; font-size: 20px;'>Brand name must not empty</span>";
            return  $message;
        }else{

            $query = "Insert into brand (brand_name)VALUES ('$brandName')";
            $brandInsert = $this->db->insert($query);
            if($brandInsert){
                $message =  "<span style='color:green; font-size: 20px;'>Brand name insert successfully.</span>";
                return  $message;
            }
            else{

                $message =  "<span style='color:red; font-size: 20px;'>Brand name not inserted.</span>";
                return  $message;
            }
        }

    }

    public function brandyList()
    {
        $query = "select * from brand ORDER  BY id DESC ";
        $selectBrand = $this->db->select($query);
        return $selectBrand;
    }

    public function brandEdit($catID)
    {

        $query = "select * from brand WHERE id = '$catID'";
        $selectdata = $this->db->select($query);
        return $selectdata;
    }

    public function brandUpdate($brandName, $catID)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $catID = mysqli_real_escape_string($this->db->link, $catID);
        if($brandName == ""){
            $message =  "<span style='color:red; font-size: 20px;'>Brand  name must not empty</span>";
            return  $message;
        }else{

            $query = "UPDATE brand set brand_name = '$brandName' WHERE id = '$catID'";

            $updateBrand = $this->db->update($query);
            if($updateBrand){
                $message =  "<span style='color:green; font-size: 20px;'>Brand name updated.</span>";
                return  $message;
            }else{

                $message =  "<span style='color:red; font-size: 20px;'>Brand name not  updated.</span>";
                return  $message;
            }
        }
    }

    public function deleteBrand($id)
    {
        $query = "DELETE from brand WHERE id = '$id'";
        $deletequery = $this->db->delete($query);
        if($deletequery){
            $message =  "<span style='color:green; font-size: 20px;'>Brand name Deleted.</span>";
            return  $message;
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>Brand name  not Deleted.</span>";
            return  $message;
        }
    }

}