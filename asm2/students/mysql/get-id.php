<?php
require '../pdo.php';

try {
    # code...
    $sql = "SELECT * FROM students WHERE id_student = :id_student LIMIT 1;";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id_student", $_GET['get_id']);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die($e->getMessage());
}