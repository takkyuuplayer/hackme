<?php session_start(); ?>

<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
    <?php if($_SERVER['REQUEST_METHOD'] === 'GET') : ?>
    <p>太郎君「CSRF攻撃って恐ろしいね。でも重大な処理の直前にトークンのチェックを入れておけば大丈夫だよね？」</p>
    <p>交換処理が確定する「confirm.php → commit.php」を重大な処理だと考えた太郎君は、commit.phpでCSRFトークンを確認することにしました。</p>
    <p>果たしてCSRF対策を施すのはそこだけで十分なのでしょうか?</p>
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
