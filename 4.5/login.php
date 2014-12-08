<?php session_start(); ?>

<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
    <?php if($_SERVER['REQUEST_METHOD'] === 'GET') : ?>
    <p>太郎君はとあるサイトのポイント交換機能を実装することになりました。</p>
    <hr>
        ログインしてね！
        <form action="login.php" method="POST">
            <input name="user" type="text" placeHolder="ユーザー名">
            <input type="submit">
        </form>
    <?php elseif($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <?php session_regenerate_id(true);
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['point'] = 10000;
        ?>
        <p>
        こんにちは <?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?> さん！
        </p>
        <p>
        あなたは今 <?php echo htmlspecialchars($_SESSION['point'], ENT_QUOTES, 'UTF-8'); ?> ポイント持っているよ!
        </p>
        <a href="form.php">ポイント交換する</a>
    <?php endif; ?>
  </body>
</html>
