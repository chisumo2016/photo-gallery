<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php
    $photos = Photo::find_all();
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
                        Photos
                        <small>Subheading</small>
                    </h1>
                      <div class="col-md-12">
                          <table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>File Name</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                                  <?php
                                      foreach ($photos as $photo)  : ?>
                                          <tr>
                                              <td><?php echo $photo->photo_id; ?></td>
                                              <td><img src="http://placehold.it/62x62" alt=""></td>
                                              <td><?php echo  $photo->title; ?></td>
                                              <td><?php echo  $photo->filename; ?></td>
                                              <td><?php echo  $photo->type; ?></td>
                                              <td><?php echo  $photo->size; ?></td>
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