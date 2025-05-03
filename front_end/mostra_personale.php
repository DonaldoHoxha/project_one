<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personale</title>
</head>

<body>
    <?php
    include_once '../back_end/db_conn.php';
    $query = $conn->prepare("SELECT * FROM barbiere");
    $query->execute();
    $result = $query->get_result();
    if (mysqli_num_rows($result) >= 1) {
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            echo $count . ":" . $row['name'] . "<br>";
            $count++;
        }
    }
    ?>
</body>

</html>