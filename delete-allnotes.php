<?php 
    session_start();
     include('../config/constants.php');
 
    if(isset($_GET['id']) AND isset($_GET['image_name']) AND isset($_GET['doc_name']) ) //Either use '&&' or 'AND'
    { 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        $doc_name = $_GET['doc_name']; 
        if($image_name != "")
        { 
            $path = "../images/icon/".$image_name; 
            $remove = unlink($path); 
            if($remove==false)
            { 
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                 header('location:manage-note.php');
                 die();
            } 
        if($doc_name != "")
        { 
            $path = "../images/icon/".$doc_name; 
            $remove = unlink($path); 
            if($remove==false)
            {
                 $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                 header('location:manage-note.php');
                 die();
            }
        }

         $sql = "DELETE FROM tbl_notes WHERE id=$id";
         $res = mysqli_query($conn, $sql); 
        if($res==true)
        {
             $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:manage-note.php');
        }
        else
        {
             $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:manage-note.php');
        }

        

    }
    else
    {
          $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:manage-note.php');
    }
}
?>
