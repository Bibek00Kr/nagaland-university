<?php
$servername = "localhost";
$username = "root";  // default username for XAMPP
$password = "";      // default password for XAMPP (leave empty if no password)
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "<script>
                alert('Login successful!');
                window.location.href = 'homepage.html';
              </script>";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}

$conn->close();
?>
