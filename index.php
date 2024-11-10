<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnchorzUp URL Shortener</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
          <div>
           <div class="logo-container"> <img src="logo.svg" alt="AnchorzUp Logo"></div>
            <h3 class="list-url_title"><b>My shortened URLs</b></h3>
            <ul id="shortened-urls">
                <?php include 'list_urls.php'; ?>
            </ul>
            </div></div>
        <div class="main-content">
            <h2>URL Shortener</h2>
            <form action="shorten.php" method="POST">
              <div class="">
                <input type="text" name="url" placeholder="Paste the URL to be shortened" required>
                <select name="expiry">
                    <option value="">Add expiration date</option>
                    <option value="1">1 minute</option>
                    <option value="5">5 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="60">1 hour</option>
                    <option value="300">5 hours</option>
                </select>
                </div>
                <button type="submit" class="action-button">Shorten URL</button>
            </form>
       
        </div>
    
    </div>
</body>
</html>
