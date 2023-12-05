<?php require 'mysql/select.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 MaxCDN link here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>home</title>
    <style>
        body {
            font-family: 'Montserrat', 'Noto Sans KR', 'Malgun Gothic', '맑은 고딕', Dotum, '돋움', 'AppleGothic', 'Apple SD Gothic Neo', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        thead {
            background-color: tomato;
        }

        img {
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <a class="btn btn-primary my-2" href="create.php">them</a>
        <a class="btn btn-secondary" href="../logout.php">dang xuat</a>
        <table>
            <thead>
                <tr>
                    <th class="col-1">id</th>
                    <th>major</th>
                    <th>code</th>
                    <th>name</th>
                    <th>image</th>
                    <th class="col-1">action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($result) {
                    foreach ($result as $value) {
                        $id    = $value['s_id_student'];
                        $major = $value['m_name_major'];
                        $code  = $value['s_code_student'];
                        $name  = $value['s_name_student'];
                        $image = $value['s_image_student'];

                        echo '
                    <tr>
                        <th>' . $id    . '</th>
                        <td>' . $major . '</td>
                        <td>' . $code  . '</td>
                        <td>' . $name  . '</td>
                        <td>
                            <img src="' . $image . '">  
                        </td>
                        <td>
                            <div class="d-grid gap-2">
                                <a class="btn btn-outline-success" href="edit.php?get_id=' . $id . '">sua</a>
                                <button class="btn btn-outline-danger" onclick="confirmDelete(' . $id . ')">xoa</button>
                            </div>
                        </td>
                    </tr>
                    ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id) {
            // Display a confirmation dialog
            var result = window.confirm("Delete item?");

            if (result) {
                // If the user clicks "OK," redirect to delete.php with the id parameter
                window.location.href = 'mysql/delete.php?get_id=' + id;
            } else {
                // If the user cancel, do nothing
            }
        }
    </script>
</body>

</html>