<?php include("includes/init.php"); ?>
<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

 if (empty($_GET['id'])){
     redirect("users.php");
 }

 //Find the id
 $user = User::find_by_id($_GET['id']);
 if ($user){

     $session->message("The user {$user->id} has been deleted");

     $user->delete();

     //refresh
     redirect("users.php");
 }else{

     redirect("users.php");
 }


?>