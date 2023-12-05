<?php
require '../../pdo.php';
require '../validate.php';

try {
    # code...
    $tableStudent = 'students';

    $sql = "UPDATE $tableStudent
            SET code_student  = :code_student,
                name_student  = :name_student,
                image_student = :image_student,
                id_major      = :id_major WHERE id_student = :id_student
            ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_student'  , $_POST["key"]);
    $stmt->bindParam(':id_major'    , $_POST["nganh"]);
    $stmt->bindParam(':code_student', $_POST["mssv"]);
    $stmt->bindParam(':name_student', $_POST["ten"]);

    $img = $_FILES['hinh'] ?? null;
    $pathSaveDB = $_POST['img-current']; // Lưu lại giá trị ảnh hiện tại
    // Xử lý upload ảnh
    if ($img) { // Khi mà có upload ảnh lên thì mới xử lý upload

        $pathUpload = __DIR__ . '/../uploads/' . $img['name'];

        // Upload file lên để lưu trữ
        if (move_uploaded_file($img['tmp_name'], $pathUpload)) {
            $pathSaveDB = 'uploads/' . $img['name'];
        }
    }
    $stmt->bindParam(':image_student', $pathSaveDB);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Location: ../index.php');
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
    die;
}