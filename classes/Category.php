<?php
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../library/Database.php');
    include_once ($filePath.'/../helper/Format.php');
?>

<?php


class Category
{

    private  $db;
    private  $fm;

    public  function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function  categoryInsert($catname)
    {

            $catName = $this->fm->validation($catname);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            if($catName == ""){
                $message =  "<span style='color:red; font-size: 20px;'>Category name must not empty</span>";
                return  $message;
            }else{

                $query = "Insert into category (cat_name)VALUES ('$catName')";
                $catInsert = $this->db->insert($query);
                if($catInsert){
                    $message =  "<span style='color:green; font-size: 20px;'>Category name insert successfully.</span>";
                    return  $message;
                }
                else{

                    $message =  "<span style='color:red; font-size: 20px;'>ategory name not inserted.</span>";
                    return  $message;
                }
            }

    }

    public function categoryList()
    {
        $query = "select * from category ORDER  BY id DESC ";
        $selectCat = $this->db->select($query);
        return $selectCat;
    }

    public function editCategory($catID)
    {
        $query = "select * from category WHERE id = '$catID'";
        $selectdata = $this->db->select($query);
        return $selectdata;
    }

    public function categoryUpdate($catname , $catID)
    {

        $catname = $this->fm->validation($catname);
        $catname = mysqli_real_escape_string($this->db->link, $catname);
        $catid = mysqli_real_escape_string($this->db->link, $catID);
        if($catname == ""){
            $message =  "<span style='color:red; font-size: 20px;'>Category name must not empty</span>";
            return  $message;
        }else{

        $query = "UPDATE category set cat_name = '$catname' WHERE id = '$catid'";

        $updatecat = $this->db->update($query);
        if($updatecat){
            $message =  "<span style='color:green; font-size: 20px;'>Category name updated.</span>";
            return  $message;
            header('location:catedit.php');
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>Category name not  updated.</span>";
            return  $message;
        }
        }

    }

    public function deleteCategory($id)
    {

        $query = "DELETE from category WHERE id = '$id'";
        $deletequery = $this->db->delete($query);
        if($deletequery){
            $message =  "<span style='color:green; font-size: 20px;'>Category name Deleted.</span>";
            return  $message;
        }else{

            $message =  "<span style='color:red; font-size: 20px;'>Category name  not Deleted.</span>";
            return  $message;
        }

    }





}