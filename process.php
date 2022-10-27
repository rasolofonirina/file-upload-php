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
        $message = '<div class="alert alert-danger" role="alert">File is not an image.</div>';
    }

    // Check if file already exists
    if (file_exists($new_name)) {
        $error = true;
        $message = '<div class="alert alert-danger" role="alert">Sorry, file already exists.</div>';
    }

    // Check file size (in this case > 1 Mo)
    if ($file_size > (1024 * 1024)) {
        $error = true;
        $message = '<div class="alert alert-danger" role="alert">Sorry, your file is too large.</div>';
    }

    // Allow certain file formats
    if (
        $extension != 'jpg'
        && $extension != 'jpeg'
        && $extension != 'png'
        && $extension != 'gif'
    ) {
        $error = true;
        $message = '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
    }

    // Check if there's no error
    if ($error === true) {
        $message = '<div class="alert alert-danger" role="alert">Sorry, your file was not uploaded.</div>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($temp_name, $target_file)) {
            $error = false;
            $message = '<div class="alert alert-success" role="alert">The file has been uploaded.</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Result</title>
    </head>

    <body class="d-flex align-items-center align-self-center">

        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 text-center">
                    <?= $message ?? ''; ?>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="assets/js/app.js"></script>
    </body>

    </html>
<?php
} else {
    header('Location: index.php');
}
