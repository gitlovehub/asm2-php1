<?php 
require '../pdo.php';

try {
    # code...
    $sql = "SELECT * FROM majors";

    $stmt = $conn->prepare($sql);

    $stmt->execute();
    $allMajors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
    die;
}