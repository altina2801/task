<?php
// Include the database connection
include 'db_connection.php';

if (isset($_GET['code'])) {
    $short_code = $_GET['code'];

    try {
        $stmt = $pdo->prepare("DELETE FROM urls WHERE short_code = :short_code");
        $stmt->bindParam(':short_code', $short_code);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    } catch (PDOException $e) {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
