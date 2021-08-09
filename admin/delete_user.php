<?php include("includes/init.php"); ?>
<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

 if (empty($_GET['id'])){
     redirect("users.php");
 }

 //Find the id
 $photo = User::find_by_id($_GET['id']);
 if ($photo){

     $photo->delete();

     //refresh
     redirect("users.php");
 }else{

     redirect("users.php");
 }


?>