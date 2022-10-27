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
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>File upload in PHP</title>
    </head>

    <body class="d-flex align-items-center align-self-center">

        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 text-center">
                    <h1>File upload in PHP</h1>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input class="form-control" type="file" name="fileToUpload" id="file" accept="image/*" required>
                        </div>
                        <div class="mb-3 d-grid">
                            <input class="btn btn-primary" type="submit" value="Submit" name="send">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="assets/js/app.js"></script>
    </body>

    </html>
<?php } ?>