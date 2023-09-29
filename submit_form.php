<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];


    // zapis do bazy
    $servername = "localhost";
    $username = "news";
    $password = "strongpass";
    $database = "newsletter";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO subscribers (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);

    if (!$stmt->execute()) {
      echo "Error: " . $stmt->error;
    } 

    // Close the database connection
    $stmt->close();
    $conn->close();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="news_style.css" rel="stylesheet" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank you for signing up!</title>
</head>

<body>
  <div class="information">
    <h2>Thank you for subscribing to our newsletter!</h2>
    <h3><?php echo $name ?>, you subscribed to newsletter using this email: <?php echo $email ?></h3>
    <p>From now on, we will keep you informed of any news.</p>
    <p>Thank you for being with us!</p>
  </div>
  <footer>
    <p id="copyright" class="copyright-text">
      Copyright &copy; 2027 by Bookstore.
    </p>
  </footer>
</body>

</html>