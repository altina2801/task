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
                echo '<li>';
                echo '<a href="redirect.php?code=' . htmlspecialchars($url['short_code']) . '" target="_blank">';
                echo 'https://shorturl.co/' . htmlspecialchars($url['short_code']);
                echo '</a>';
                echo ' <button onclick="deleteUrl(\'' . htmlspecialchars($url['short_code']) . '\')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 " height="20" width="20" >
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
</button>';
                echo '</li>';
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

