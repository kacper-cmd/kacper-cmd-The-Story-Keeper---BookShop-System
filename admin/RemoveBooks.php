<?php 
include('../config/connection.php');

function redirect($location) {
    header("Location: $location");
    exit;
}
if(isset($_POST['id']) && isset($_POST['image_name'])){
    
    $id = $_POST['id'];
    $image_name = $_POST['image_name'];
   //remove the physical image file if available
   //check whether the image is available or not and delete only if available
   if($image_name != ""){
       $path = "../images/books/".$image_name;
       $remove = unlink($path);//unlink() function removes the file
         //check whether the image is removed or not
            //if failed to remove then display error message and stop the process
            if($remove==false){
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
               // header('location:'.'manageBooks.php');
                redirect('manageBooks.php');
                       
            }
   }
    $sql = "DELETE FROM book WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Book deleted successfully.</div>";
       // header('location:'.'manageBooks.php');
        redirect('manageBooks.php');
        
        
    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete book.</div>";
       // header('location:'.'manageBooks.php');
        redirect('manageBooks.php');
    
              
    }
}else{
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    //header('location:'.'manageBooks.php');
    redirect('manageBooks.php');
}

?>