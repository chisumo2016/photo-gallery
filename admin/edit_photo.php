<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php

 //check if the id
if(empty($_GET['id'])){
    redirect("photos.php");
}else{
    $photo = Photo::find_by_id($_GET['id']);

    if (isset($_POST['update'])){

     if ($photo){

         //Assign to object property
            $photo-> title          =   $_POST['title'];
            $photo-> caption        =   $_POST['caption'];
            $photo-> description    =   $_POST['description'];
            $photo-> alternative_text =   $_POST['alternative_text'];

            $photo->save();

        }
    }
}

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
                    <form action="" method="post">
                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="">Title</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id=""
                                        name="title"
                                        value="<?php echo $photo->title; ?>"
                                        placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Avatar</label>
                                <a href="" class="thumbnail">
                                    <img src="<?php  echo $photo->picture_path();?>" alt="">
                                </a>
                                       
                            </div>
                            <div class="form-group">
                                <label for="Caption">Caption</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="" name="caption"
                                        value="<?php echo $photo->caption; ?>"
                                        placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="">Alternative Text</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="alternate_text"
                                        name="alternative_text"
                                        value="<?php  echo $photo->alternative_text; ?>"
                                        placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="summernote">Description</label>
                                <textarea
                                        class="form-control"
                                        id="summernote"
                                        name="description"
                                        rows="15"
                                        cols="30"><?php  echo $photo->description; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="photo-info-box">
                                <div class="info-box-header">
                                    <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                                <div class="inside">
                                    <div class="box-inner">
                                        <p class="text">
                                            <span class="glyphicon glyphicon-calendar"></span> Uploaded on: July 22, 2030 @ 5:26
                                        </p>
                                        <p class="text">
                                            Photo ID : <span class="data photo_id_box">34</span>
                                        </p>
                                        <p class="text">
                                            Filename : <span class="data">image.jpg</span>
                                        </p>
                                        <p class="text">
                                            File Type : <span class="data">jpg</span>
                                        </p>
                                        <p class="text">
                                            File Size: <span class="data">3445555</span>
                                        </p>
                                    </div>
                                    <div class="info-box-footer clearfix">
                                        <div class="info-box-delete pull-left">
                                            <a href="delete_photo.php?id=<?php $photo->id;?>" class="btn btn-danger btn-lg">Delete</a>
                                        </div>

                                        <div class="info-box-update pull-right">
                                            <input type="submit" name="update" value="update" class="btn btn-lg btn-primary">
                                        </div>
                                    </div>
                                </div>
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