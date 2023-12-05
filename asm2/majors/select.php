<?php 

require '../pdo.php';

try {
    # code...
    $tableMajors = 'majors';

    $sql = " SELECT * FROM $tableMajors";

    $stmt = $conn->prepare($sql);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
    die;
}