<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AnchorzUp URL Shortener</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="sidebar">
        <h2>anchorzup</h2>
        <h3>My shortened URLs</h3>
        <div id="shortened-urls">
         
          <?php include 'list_urls.php'; ?>
        </div>
      </div>
      <div class="main-content">
        <h2>URL Shortener</h2>
        <form action="shorten.php" method="POST">
          <input
            type="text"
            name="url"
            placeholder="Paste the URL to be shortened"
            required
          />
          <select name="expiry">
            <option value="">Add expiration date</option>
            <option value="1">1 minute</option>
            <option value="5">5 minutes</option>
            <option value="30">30 minutes</option>
            <option value="60">1 hour</option>
            <option value="300">5 hours</option>
          </select>
          <button type="submit">Shorten URL</button>
        </form>
      </div>
    </div>
  </body>
</html>
