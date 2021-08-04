<?php require_once("includes/header.php");?>

<?php


if ($session->is_signed_in()){
      redirect('index.php');
  }
  //checking form submition
if (isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Method Check the database user
    $user_found =User::verify_user($username , $password);
    //print_r( $user_found);

    if ($user_found){
        $session->login($user_found);
        redirect("index.php");

    }else{
        $the_message = "Your password or username are incorrect";
    }
}else{
    $username ="";
    $password ="";
    $the_message="";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <div class="col-md-4 col-md-offset-3">
       <h4 class="bg-danger"><?php echo $the_message; ?></h4>

       <form action="" method="post">
          <div class="form-group">
              <label for="username">Username</label>
              <input type="text"  name="username" class="form-control" value="<?php echo htmlentities($username); ?>">
          </div>
           <div class="form-group">
               <label for="username">Password</label>
               <input type="password"  name="password" class="form-control" value="<?php echo htmlentities($password); ?>">
           </div>

           <div class="form-group">
               <input type="submit" name="submit" value="submit" class="btn btn-primary">
           </div>
       </form>
   </div>

</body>
</html>
