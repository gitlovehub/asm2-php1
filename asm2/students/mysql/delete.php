<?php 
require '../../pdo.php';

session_start();

if (empty($_SESSION["key"])) {
    echo '<script>
            alert("Please login.");
            window.location.href = "../../login.php";
          </script>';
    exit();
}

try {
    # code...
    $id = $_GET["get_id"];

    $sql = "DELETE FROM students WHERE id_student = $id";

    $stmt = $conn->prepare($sql);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Location: ../index.php');
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
    die;
}