<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Pictures Gallery</title>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1>Image Gallery</h1>
    </div>
</div>
   

    <?php
        $message = "Choose a file to upload.";

        $upload_errors = array(
            UPLOAD_ERR_OK 				=> "No errors.",
            UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
            UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
            UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
            UPLOAD_ERR_NO_FILE 			=> "No file.",
            UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
            UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
            UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension.");

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //taking the file from computer
                $tmp_file = $_FILES['file_upload']['tmp_name'];

                // set target file name
                // basename gets just the file name
                $target_file = basename($_FILES['file_upload']['name']);

                //uploading folder
                $upload_dir = 'pictures';

                //if file is uploaded successfully... then message it, not then error.... otherwise delete
                if(move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)){
                    $message = "File uploaded successfully";
                } else if($_SERVER['REQUEST_METHOD'] == "GET"){
                }
            
            }
    ?>

 
<div class="container">
    <h3><?php echo $message ?></h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
        <input class="btn btn-outline-info" type="file" name="file_upload">
        <input class="btn btn-outline-info" type="submit" value="Upload">
    </form>
</div>


<div class="container">

<?php
     $pic = '';
     $dir = "pictures";
     $column = 4;
    
    if(is_dir($dir)){
        $dir_array = scandir($dir);
        foreach ($dir_array as $pic) {
            if(strpos($pic,'.') > 0){
                echo '<br></br>';
                echo '<div class="container">';
                echo '<div class="photo">';
                echo '<img src="' . $dir . '/' . $pic . '"  alt="" style="width:25%">';
                echo '<a href="?del=' . $pic . '" role="button">Delete</a></div></div>';
                echo '</div>';     
            }
        }
    }

    if (isset($_GET['del'])){
        echo $_GET['del'];
        unlink ('pictures/'. $_GET['del']);
            echo "Your picture is deleted";
    }
?>

</div>
</body>
</html>