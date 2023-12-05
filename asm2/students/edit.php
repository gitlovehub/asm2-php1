<?php
require 'mysql/get-id.php';
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

    <title>update</title>
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

        <form action="mysql/update.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="key" value="<?= $_GET['get_id'] ?>">

            <label for="nganh">nganh hoc:</label>
            <select class="form-control" name="nganh" id="nganh">
                <?php foreach ($allMajors as $value) : ?>
                    <option <?= $value['id_major'] == $result['id_major'] ? 'selected' : '' ?>
                    value="<?= $value['id_major'] ?>">
                        <?= $value['name_major'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="mssv">mssv:</label>
            <input class="form-control" type="text" name="mssv" id="mssv" value="<?= $result['code_student'] ?>">
            <br>
            <label for="ten">ten:</label>
            <input class="form-control" type="text" name="ten" id="ten" value="<?= $result['name_student'] ?>">
            <br>
            <label for="hinh">hinh anh:</label>
            <input class="form-control" type="file" name="hinh" id="hinh" onchange="previewImage()">
            <!-- Show img -->
            <input type="hidden" name="img-current" id="img-current" value="<?= $result['image_student'] ?>">
            <img id="img-preview" src="<?= $result['image_student'] ?>" width="150px" height="150px" class="mt-2">
            <br>
            <button class="btn btn-primary float-end" type="submit">save</button>

        </form>

        <button onclick="deleteImage()">xóa ảnh</button>
    </div>

    <script>
        var imgPreview = document.getElementById('img-preview');
        var imgCurrent = document.getElementById('img-current');
        var input      = document.getElementById('hinh');

        function previewImage() {

            // Check if a file is selected
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);

                // Update the hidden input value to the new image data
                imgCurrent.value = '';
            } else {
                // If no file is selected, keep the current image
                imgPreview.src = imgCurrent.value;
            }
        }

        function deleteImage() {
            imgCurrent.value = '';
            imgPreview.src   = '';
        }
    </script>
</body>

</html>