<?php
include 'checkreg.php' ;

$temp = explode(".",$_FILES["fileToUpload"]["name"]);
$profilepic = $_SESSION['roll'].'.'.end($temp);
$target_dir = "";
$target_file = $target_dir . $profilepic;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is a valid image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {	
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The image ". $profilepic . " has been uploaded to the directory www . ";
		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>