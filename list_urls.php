<?php
include 'db_connection.php';

try {
    // Fetch URLs ordered by creation date
    $stmt = $pdo->query("SELECT id, original_url, short_code, expiry_time FROM urls ORDER BY created_at DESC");
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($urls) {
        foreach ($urls as $url) {
            // Check if the link is expired
            if (is_null($url['expiry_time']) || strtotime($url['expiry_time']) > time()) {
                echo '<div>';
                echo '<a href="redirect.php?code=' . htmlspecialchars($url['short_code']) . '" target="_blank">';
                echo 'https://shorturl.co/' . htmlspecialchars($url['short_code']);
                echo '</a>';
                echo ' <button onclick="deleteUrl(\'' . htmlspecialchars($url['short_code']) . '\')">🗑️</button>';
                echo '</div>';
            }
        }
    } else {
        echo '<p>No URLs found.</p>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<script>
function deleteUrl(shortCode) {
    if (confirm("Are you sure you want to delete this URL?")) {
        // Create an AJAX request to delete.php
        fetch(`delete.php?code=${shortCode}`, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    alert("URL deleted successfully.");
                    location.reload(); // Reload the page to update the list
                } else {
                    alert("Error deleting URL.");
                }
            })
            .catch(error => console.error("Error:", error));
    }
}
</script>

