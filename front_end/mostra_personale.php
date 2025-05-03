<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personale</title>
    <script>
        function prenota_appuntamento(id) {
            fetch('mostra_orari.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + encodeURIComponent(id)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        // update the cart items count
                        let cartCount = document.querySelector('.cart-count');
                        cartCount.textContent = parseInt(cartCount.textContent) + 1;
                    } else {
                        alert("Errore: " + data.message);
                    }
                })
                .catch(error => console.error('Errore:', error));
        }
    </script>
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
            echo "<a href='mostra_orari.php?id=" . $row['id'] . "'><button class='button'>Prenota ora</button></a><br>";
            $count++;
        }
    }
    ?>
</body>

</html>