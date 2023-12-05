<?php
require '../../pdo.php';
require '../validate.php';

try {
    # code...
    $tableName = 'students';

    // Kiểm tra trùng lặp tên trước khi thêm vào cơ sở dữ liệu
    $check_duplicate_sql = "SELECT COUNT(*) as count FROM $tableName WHERE code_student = :code_student";
    $check_stmt = $conn->prepare($check_duplicate_sql);
    $check_stmt->bindParam(':code_student', $_POST["mssv"]);
    $check_stmt->execute();
    $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
    $count = $row['count'];
    if ($count > 0) {
        // Nếu đã tồn tại, hiển thị lỗi
        $_SESSION['error']['mssv'] = '<span style="color: red;">"' . $_POST["mssv"] . '"</span> already exists. Please choose a different.';
        header('Location: ../create.php');
        exit();
    }
    
    $sql = "INSERT INTO $tableName(id_major, code_student, name_student, image_student)
    VALUE (:id_major, :code_student, :name_student, :image_student);";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_major'    , $_POST["nganh"]);
    $stmt->bindParam(':code_student', $_POST["mssv"]);
    $stmt->bindParam(':name_student', $_POST["ten"]);

    $img = $_FILES['hinh'] ?? null;
    $pathSaveDB = '';
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