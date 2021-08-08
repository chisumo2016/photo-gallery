<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php
    //$photos = Photo::find_all();
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
                        Edit Photos
                        <small>Subheading</small>
                    </h1>
                      <div class="col-md-8">
                          <form>
                              <div class="form-group">
                                  <label for="">Title</label>
                                  <input type="text" class="form-control" id="" name="title" placeholder="">
                              </div>
                              <div class="form-group">
                                  <label for="Caption">Caption</label>
                                  <input type="text" class="form-control" id="" name="caption" placeholder="">
                              </div>

                              <div class="form-group">
                                  <label for="">Alternative Text</label>
                                  <input type="text" class="form-control" id="alternative_text"  name="alternative_text" placeholder="">
                              </div>

                              <div class="form-group">
                                  <label for="">Description</label>
                                  <textarea class="form-control" id=""  name="description" rows="3"></textarea>
                              </div>
                          </form>
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