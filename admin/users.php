<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php
$users = User::find_all();
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
                       View Users

                    </h1>
                    <a href="add_user.php" class="btn btn-primary">Add New User</a>

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><img class="admin-photo-thumbnail user_image" src="<?php echo $user->image_path_placeholder(); ?>" alt=""></td>

                                    <td>
                                        <?php echo  $user->username; ?>
                                        <div class="action_links">
                                            <a href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-xs btn-danger">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id; ?>" class="btn btn-xs btn-warning">Edit</a>
                                            <a href="#" class="btn btn-xs btn-primary">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo  $user->first_name; ?></td>
                                    <td><?php echo  $user->irst_name; ?></td>
                                    <td><?php echo  $user->size; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table><!--End of Table-->
                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.container-fluid -->

    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>