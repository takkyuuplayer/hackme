<?php require_once __DIR__ . '/../../vendor/autoload.php' ?>
<?php session_start(); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = \Hackme\Heroku\ClearDB::getConnection();
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $stmt = $con->prepare("SELECT * FROM user WHERE email = '$email' AND password = '$pass'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
      $_SESSION['user_id'] = $row['id'];
    } else {
      $_SESSION['error'] = 'Incorrect email or password';
    }
}
header('Location: index.php');
