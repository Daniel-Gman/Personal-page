<?php
$dbname = "formulier.db";

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

try {
    $conn = new PDO("sqlite:$dbname");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $insertQuery = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    header("location: login.html?alert=true");
    exit;
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}
?>
