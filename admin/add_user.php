<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php


    $user = new User();

    if (isset($_POST['create'])){
     if ($user){

         var_dump($user);

         //Assign to object property
            $user->username          =   $_POST['username'];
            $user->first_name        =   $_POST['first_name'];
            $user->last_name         =   $_POST['last_name'];
            $user->password          =   $_POST['password'];

            $user->set_file($_FILES['user_image']);
            $user->save_user_image();

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
                        Add New User
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">

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
                                        placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        placeholder="Enter First Name">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        placeholder="Enter Last Name">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                            </div>
                            <div class="form-group">
                                <input
                                        type="submit"
                                        class="btn btn-primary pull-right"
                                        name="create"
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