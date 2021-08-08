<?php include("includes/init.php"); ?>
<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

 if (empty($_GET['id'])){
     redirect("../photos.php");
 }

 //Find the id
 $photo = Photo::find_by_id($_GET['id']);
 if ($photo){
     $photo->delete_photo();
     //refresh
     redirect("../photos.php");
 }else{

     redirect("../photos.php");
 }


?>