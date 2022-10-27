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

                <form action="process.php" method="POST" enctype="multipart/form-data">
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