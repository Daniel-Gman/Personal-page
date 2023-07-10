<?php
$dbname = "formulier.db";

$login_username = $_POST['username'];
$login_password = $_POST['password'];

try {
    $conn = new PDO("sqlite:$dbname");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $selectQuery = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':username', $login_username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['password'] === $login_password) {
        header("location: Index.html");
        exit;
    } else {
        header("location: login.html?wrong=true");
    }
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}
?>
