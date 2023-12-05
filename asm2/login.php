<?php

session_start();

if (!empty($_POST)) {
    # code...
    $username = 'admin';
    $password = '1234';

    if ($username == $_POST["name"] && $password == $_POST["pass"]) {
        $_SESSION["key"] = [
            'username' => $_POST["name"],
            'password' => $_POST["pass"]
        ];

        header('Location: students/index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 MaxCDN link here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>log in</title>
</head>

<body>
    <div class="container col-lg-4 col-md-8">
        <h1 class="text-center">LOG IN</h1>
        <form action="" enctype="multipart/form-data" method="post">

            <label class="fw-semibold pt-2" for="name">Username:</label>
            <input class="form-control" type="text" name="name" id="name">

            <label class="fw-semibold pt-2" for="pass">Password:</label>
            <input class="form-control" type="password" name="pass" id="pass">

            <div class="d-grid pt-4">
                <button class="btn btn-primary" type="submit">log in</button>
            </div>

        </form>
    </div>
</body>

</html>