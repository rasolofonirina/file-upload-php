<?php
if (!empty($_POST['send']) && !empty($_FILES['fileToUpload'])) {
    $target_directory = "uploads/";
    $target_file = $target_directory . basename($_FILES['fileToUpload']['name']);
    $error = false;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if ($check !== false) {
        // echo $check['mime'];
        $error = false;
    } else {
        $error = true;
        echo 'File is not an image.';
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $error = true;
        echo 'Sorry, file already exists.';
    }

    // Check file size (in this case > 1 Mo)
    if ($_FILES['fileToUpload']['size'] > (1024 * 1024)) {
        $error = true;
        echo 'Sorry, your file is too large.';
    }

    // Allow certain file formats
    if (
        $imageFileType != 'jpg'
        && $imageFileType != 'png'
        && $imageFileType != 'jpeg'
        && $imageFileType != 'gif'
    ) {
        $error = true;
        echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    }

    // Check if there's no error
    if ($error === true) {
        echo 'Sorry, your file was not uploaded.';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $error = false;
            echo 'The file ' . htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . ' has been uploaded.';
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    }
} else {
    header('Location: index.php');
}
