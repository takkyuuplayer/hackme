<?php require_once __DIR__ . '/../../vendor/autoload.php' ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>SQL injection 01</title>
</head>

<body>
  <a href="/">TOP</a>
  <p style="padding:1em; background-color:#EEE;">Q. SQL Injection の脆弱性を突き、test@user.com としてログインせよ</p>
  <?php session_start(); ?>
    <?php if ($_SESSION['user_id']) : ?>
      <?php $con = \Hackme\Heroku\ClearDB::getConnection();
          $stmt = $con->prepare('SELECT * FROM user WHERE id = ?');
          $stmt->execute(array($_SESSION['user_id']));
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>
      ようこそ <?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?> さん！
      <a href="logout.php">logout</a>
    <?php else : ?>
      <form action="login.php" method="POST">
        <input type="text" name="email" placeHolder="email">
        <input type="password" name="password" placeHolder="password">
        <input type="submit" value="Login">
      </form>
      <?php if(isset($_SESSION['error'])) {
        echo htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8');
        unset($_SESSION['error']);
      } ?>
    <?php endif; ?>
</body>
</html>
