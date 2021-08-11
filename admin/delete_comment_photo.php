<?php include("includes/init.php"); ?>
<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

 if (empty($_GET['id'])){
     redirect("comments.php");
 }

 //Find the id
 $comment = Comment::find_by_id($_GET['id']);
 if ($comment){

     $comment->delete();

     $session->message("The comment with {$comment->id} has been deleted");

     //refresh
    // redirect("comment_photo.php?id={$comment->photo_id}");
     redirect("comment_photo.php?id={$_GET['id']}");
 }else{

     redirect("comments.php");
 }


?>