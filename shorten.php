<?php
$dsn = "mysql:host=localhost;dbname=url_shortener;charset=utf8";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $original_url = $_POST["url"];
    $expiry_minutes = $_POST["expiry"] ?? 0;
    $short_code = substr(md5(uniqid(rand(), true)), 0, 5);

    $expiry_time = $expiry_minutes > 0 ? date('Y-m-d H:i:s', strtotime("+$expiry_minutes minutes")) : null;

    $stmt = $pdo->prepare("INSERT INTO urls (original_url, short_code, expiry_time) VALUES (:original_url, :short_code, :expiry_time)");

    try {
        $stmt->execute([
            'original_url' => $original_url,
            'short_code' => $short_code,
            'expiry_time' => $expiry_time
        ]);
        header("Location: index.php");  // Redirect to index.php
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
