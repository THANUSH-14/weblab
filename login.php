<?php
if (!isset($_POST['uname']) || !isset($_POST['upswd'])) {
    echo "Username and password are required.";
    exit;
}

$uname = $_POST['uname'];
$upswd = $_POST['upswd'];

$conn = new mysqli("localhost", "root", "", "project");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT upswd1 FROM register WHERE uname1 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uname);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    if ($upswd === $stored_password) {
        include("flyhigh.html");
    } else {
        echo "<h2>Invalid username or password.</h2>";
    }
} else {
    echo "<h2>Invalid username or password.</h2>";
}

$stmt->close();
$conn->close();
?>

