<?php
// Include the database connection
include 'db_connection.php';

// Get the short code from the URL
if (isset($_GET['code'])) {
    $short_code = $_GET['code'];

    try {
        // Fetch the original URL and expiry time using the short code
        $stmt = $pdo->prepare("SELECT original_url, expiry_time FROM urls WHERE short_code = :short_code LIMIT 1");
        $stmt->bindParam(':short_code', $short_code);
        $stmt->execute();
        $urlData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($urlData) {
            // Check if the link is expired
            if (is_null($urlData['expiry_time']) || strtotime($urlData['expiry_time']) > time()) {
                // Redirect to the original URL
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
