<?php session_start(); ?>

<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
    <?php if(empty($_SESSION['user'])) : ?>
        まず<a href="login.php">ログイン</a>してね！
    <?php elseif($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
<?php $_SESSION['kouza'] = $_POST['kouza'];
      $_SESSION['exchange'] = $_POST['exchange'];
?>
    下で交換するよ？良ければ送信ボタンを押してね！
    <ul>
      <li>銀行口座: <?php echo htmlspecialchars($_POST['kouza'], ENT_QUOTES, 'UTF-8'); ?></li>
      <li>ポイント: <?php echo htmlspecialchars($_POST['exchange'], ENT_QUOTES, 'UTF-8'); ?>ポイント
        <span style="color:#CCC;">(※要フォームバリデーション) </span>
      </li>
      <li>残ポイント: <?php echo htmlspecialchars($_SESSION['point'] - $_POST['exchange'], ENT_QUOTES, 'UTF-8'); ?>ポイント</li>
    </ul>
    <form action="commit.php" method="POST">
        <p>hidden で csrf token が入っているよ</p>
        <input type="hidden" name="_csrf_token" value="<?php echo md5(__DIR__ . session_id() . 'secret_seed'); ?>" />
        <input type="submit" />
    </form>
    <?php else : ?>
        <a href="form.php">ちゃんと交換フォームから来てね</a>
    <?php endif; ?>
  </body>
</html>

