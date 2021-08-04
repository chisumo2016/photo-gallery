<?php
if (isset($_POST['submit'])){
//   echo "<pre>";
//    print_r($_FILES['image']); //print the value /arrays
//    echo "<pre>";
    //Associative array
    $uploaded_errors =
        [
            UPLOAD_ERR_OK            => "There is no error, the file uploaded with success.",
            UPLOAD_ERR_INI_SIZE      => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE     => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            UPLOAD_ERR_PARTIAL       => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE       => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR    => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE    => " Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION     => "A PHP extension stopped the file upload. ",
        ];

    $temp_name      = $_FILES['image']['tmp_name'];
    $the_file       = $_FILES['image']['name'];
    $directory      = "uploads";

    //Move upload file
    if (move_uploaded_file($temp_name , $directory  . "/" . $the_file )){
        $the_message  = "File uploaded successfully";
    }else{
        $the_error =  $_FILES['image']['error'];
        $the_message = $uploaded_errors[$the_error];
    }

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
<form action="file.php" method="post" enctype="multipart/form-data">
    <?php
        if (!empty($uploaded_errors)){
            echo   $the_message;
        }
    ?>
    <input type="file" name="image">
    <input type="submit" name="submit">
</form>
</body>
</html>
