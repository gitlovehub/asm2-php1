<?php
require 'mysql/get-all-majors.php';

session_start();

if (empty($_SESSION["key"])) {
    echo '<script>
            var ok = confirm("Please login.");
            if (ok) {
                window.location.href = "../login.php";
            } else {
                window.location.href = "index.php";
            }
          </script>';
    exit();
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

    <title>create</title>
</head>

<body>
    <div class="container col-lg-4 col-md-8">
        <a href="index.php" class="btn btn-dark my-2">back</a>

        <!-- Show error -->
        <?php if (!empty($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['error'] as $item) : ?>
                    <li><?= $item ?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="mysql/insert.php" method="post" enctype="multipart/form-data">
            <label for="nganh">nganh hoc:</label>
            <select class="form-control" name="nganh" id="nganh">
                <?php foreach ($allMajors as $value) : ?>
                    <option value="<?= $value['id_major'] ?>">
                        <?= $value['name_major'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="mssv">mssv:</label>
            <input class="form-control" type="text" name="mssv" id="mssv">
            <br>
            <label for="ten">ten:</label>
            <input class="form-control" type="text" name="ten" id="ten">
            <br>
            <label for="hinh">hinh anh:</label>
            <input class="form-control" type="file" name="hinh" id="hinh">
            <br>
            <button class="btn btn-primary" type="submit">done</button>
        </form>
    </div>
</body>

</html>