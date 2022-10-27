<?php
if (!empty($_POST["send"]) && !empty($_FILES["fileToUpload"])) {
    $parts = pathinfo($_FILES["fileToUpload"]["name"]);
    $name = strtolower($parts["filename"]);
    $extension = strtolower($parts["extension"]);

    $target_directory = "uploads/";
    $temp_name = $_FILES["fileToUpload"]["tmp_name"];
    $file_size = $_FILES["fileToUpload"]["size"];

    $new_name = sha1($name . microtime()) . "." . $extension;
    $target_file = $target_directory . basename($new_name);
    $error = false;

    // Check if image file is a actual image or fake image
    $check = getimagesize($temp_name);
    if ($check !== false) {
        // echo $check['mime'];
        $error = false;
    } else {
        $error = true;
        echo 'File is not an image.';
    }

    // Check if file already exists
    if (file_exists($new_name)) {
        $error = true;
        echo 'Sorry, file already exists.';
    }

    // Check file size (in this case > 1 Mo)
    if ($file_size > (1024 * 1024)) {
        $error = true;
        echo 'Sorry, your file is too large.';
    }

    // Allow certain file formats
    if (
        $extension != 'jpg'
        && $extension != 'jpeg'
        && $extension != 'png'
        && $extension != 'gif'
    ) {
        $error = true;
        echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    }

    // Check if there's no error
    if ($error === true) {
        echo 'Sorry, your file was not uploaded.';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($temp_name, $target_file)) {
            $error = false;
            echo 'The file has been uploaded.';
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    }
} else {
    header('Location: index.php');
}
