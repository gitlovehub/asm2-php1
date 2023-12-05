<?php 
require '../pdo.php';

try {
    # code...
    $tableStudent = 'students';

    $sql = "SELECT
        s.id_student    as s_id_student,
        m.name_major    as m_name_major,
        s.code_student  as s_code_student,
        s.name_student  as s_name_student,
        s.image_student as s_image_student
        FROM $tableStudent as s
        INNER JOIN majors as m
        ON m.id_major = s.id_major ORDER BY s.id_student ASC;";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
    die;
}