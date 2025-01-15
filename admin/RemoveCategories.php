<?php
include('../config/connection.php');
//echo "we are in remove categories";
function redirect($location) {
  header("Location: $location");
  exit;
}

if(isset($_POST['id']) && isset($_POST['image_name'])){
    $id = $_POST['id'];
    $image_name = $_POST['image_name'];
    //REMOVE THE PHYSICAL IMAGE FILE IF AVAILABLE
    if($image_name!=""){
        $path = "../images/categories/".$image_name;
        $remove = unlink($path);//unlink() function removes the file from the folder
        if($remove==false){
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
           // header('location:'.'manageCategories.php');
            redirect('manageCategories.php');
           
           
        }
    }
    $sql = "DELETE FROM bookcategory WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
       // header('location:'.'manageCategories.php');
        redirect('manageCategories.php');
    
       
    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete category. Try again later.</div>";
       // header('location:'.'manageCategories.php');
        redirect('manageCategories.php');
       
    }
}else{
   // header('location:'.'manageCategories.php');
    redirect('manageCategories.php');
    
}
?>