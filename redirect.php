<?php

include 'db_connection.php';


if (isset($_GET['code'])) {
    $short_code = $_GET['code'];

    try {
        
        $stmt = $pdo->prepare("SELECT original_url, expiry_time FROM urls WHERE short_code = :short_code LIMIT 1");
        $stmt->bindParam(':short_code', $short_code);
        $stmt->execute();
        $urlData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($urlData) {
            
            if (is_null($urlData['expiry_time']) || strtotime($urlData['expiry_time']) > time()) {
                
                header("Location: " . $urlData['original_url']);
                exit();
            } else {
                echo "This link has expired.";
            }
        } else {
            echo "URL not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No URL code provided.";
}
?>
