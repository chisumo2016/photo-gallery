<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php


//check if the id
if(empty($_GET['id'])){
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

    if (isset($_POST['update'])){

     if ($user){

         //Assign to object property
            $user->username          =   $_POST['username'];
            $user->first_name        =   $_POST['first_name'];
            $user->last_name         =   $_POST['last_name'];
            $user->password          =   $_POST['password'];

            //checking if its empty
         if (empty($_FILES['user_image'])){
              //save the image
             $user->save();

         } else {
             $user->set_file($_FILES['user_image']);

             $user->save_user_image();

             $user->save();

             redirect("edit_user.php?id={$user->id}");
         }

        }

}

    //$users = Photo::find_all();
?>


    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->

        <?php include("includes/top_nav.php");?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php");?>
        <!-- /.navbar-collapse -->
    </nav>


    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                       Edit User
                    </h1>
                    <div class="col-md-6">
                        <img class="img-responsive" src="<?php echo $user->image_path_placeholder();?>" alt="">
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="username">Avatar</label>
                                <input
                                        type="file"
                                        class="form-control"
                                        name="user_image">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="username"
                                        value="<?php echo $user->username; ?>"
                                        placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        value="<?php echo $user->first_name; ?>"
                                        placeholder="Enter First Name">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        value="<?php echo $user->last_name; ?>"
                                        placeholder="Enter Last Name">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                        type="password"
                                        class="form-control"
                                        value="<?php echo $user->password;?>"
                                        name="password">
                            </div>
                            <div class="form-group">
                                <a id="user-id" href="delete_user.php?id=<?php $user->id;?>" class="btn btn-danger">Delete</a>
                                <input
                                        type="submit"
                                        class="btn btn-primary pull-right"
                                        name="update"
                                        value="update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.container-fluid -->

    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>