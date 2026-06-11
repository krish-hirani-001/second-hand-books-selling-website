<?php
// success.php
// You can also pass messages via query string ?msg=Your+Message

$message = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : "✅ Book saved successfully!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Success</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .success-icon {
      font-size: 60px;
      color: #28a745;
    }
    h1 {
      margin: 20px 0 10px;
      font-size: 26px;
      color: #333;
    }
    p {
      color: #666;
      font-size: 16px;
    }
    a.button {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #28a745;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.3s ease;
    }
    a.button:hover {
      background: #218838;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="success-icon">✔️</div>
    <h1>Success!</h1>
    <p><?php echo $message; ?></p>
    <a href="sellbook.php" class="button">Add Another Book</a>
  </div>
</body>
</html>
