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
    <?php elseif($_SERVER['REQUEST_METHOD'] !== 'POST'
        || empty($_SESSION['kouza'])
        || empty($_SESSION['exchange'])
    ) : ?>
        <a href="form.php">ちゃんと交換フォームから来てね</a>
    <?php else : ?>
    以下の交換申請を受け付けたよ！
    <?php $_SESSION['point'] = $_SESSION['point'] - $_SESSION['exchange']; ?>
    <ul>
      <li>銀行口座: <?php echo htmlspecialchars($_SESSION['kouza'], ENT_QUOTES, 'UTF-8'); ?></li>
      <li>ポイント: <?php echo htmlspecialchars($_SESSION['exchange'], ENT_QUOTES, 'UTF-8'); ?>ポイント</li>
      <li>残ポイント: <?php echo htmlspecialchars($_SESSION['point'], ENT_QUOTES, 'UTF-8'); ?>ポイント</li>
    </ul>
<?php # logging
      require_once('../vendor/autoload.php');
      ORM::configure('sqlite:../db/4.5.sqlite3');
      $db = ORM::get_db();
      $db->exec("
        CREATE TABLE IF NOT EXISTS exchange_history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user TEXT NOT NULL,
            kouza TEXT NOT NULL,
            point INTEGER NOT NULL,
            created_at INTEGER
        );
        ");
      $history = ORM::for_table('exchange_history')->create();
      $history->user = $_SESSION['user'];
      $history->kouza = $_SESSION['kouza'];
      $history->point = $_SESSION['exchange'];
      $history->created_at = time();
      $history->save();

?>
<?php unset($_SESSION['kouza']);
      unset($_SESSION['exchange']);

?>
        <a href="form.php">もっと交換する</a>
<hr>
  <p>太郎君「よし、ポイント交換できるようになったぞ。これでリリースしよう。」</p>
  <p>ごきげんな太郎くんですが、実は太郎君の作ったポイント交換機能には深刻な脆弱性があります。</p>
  <p style="padding:1em; background-color:#EEE;">Q. 太郎くんの作ったポイント交換機能の脆弱性を突き、ユーザーに意図しないポイント行わせる罠サイトを作成せよ</p>
  <?php endif; ?>
  </body>
</html>


