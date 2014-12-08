<?php session_start(); ?>

<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
    <?php if(empty($_SESSION['user'])) : ?>
        まず<a href="4.5-login.php">ログイン</a>してね！
    <?php else : ?>
      <p>
      こんにちは <?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?> さん！
      </p>
      <p>
      あなたは今 <?php echo htmlspecialchars($_SESSION['point'], ENT_QUOTES, 'UTF-8'); ?> ポイント持っているよ!
      何ポイント交換します？1ポイント=1円ね。
      </p>
      <form action="confirm.php" method="POST">
        <input name="kouza" type="text" placeHolder="銀行口座" />
        <input name="exchange" type="text" placeHolder="交換ポイント" />
        <input type="submit" value="確認" />
      </form>
    <?php endif; ?>

<hr>
<?php require_once('./exchange_history.php'); ?>
</body>
</html>

