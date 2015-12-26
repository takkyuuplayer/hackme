<?php require_once __DIR__ . '/../../vendor/autoload.php' ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>SQL injection 02</title>
</head>

<body>
  <a href="/">TOP</a>
  <p style="padding:1em; background-color:#EEE;">Q. SQL Injection の脆弱性を突き、全ユーザーの email/password を奪取せよ</p>
  <h1>商品検索</h1>
  <form method="GET">
    <dl>
      <dt>Product name</dt>
      <dd>
        <input type="text" name="name" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
      </dd>
      <dt>Price</dt>
      <dd>
        <input type="number" name="min" min="0" value="<?php echo isset($_GET['min']) ? htmlspecialchars($_GET['min'], ENT_QUOTES, 'UTF-8') : ''; ?>"> ~
        <input type="number" name="max" min="0" value="<?php echo isset($_GET['max']) ? htmlspecialchars($_GET['max'], ENT_QUOTES, 'UTF-8') : ''; ?>">
      </dd>
    </dl>
    <input type="submit" value="search">
  </form>

  <h1>検索結果</h1>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price (JPY)</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $where = '1 = 1';
        if (!empty($_GET['name'])) {
            $where .= " AND name LIKE '%" . $_GET['name'] . "%'";
        }
        if (!empty($_GET['min'])) {
            $where .= " AND price >= '" . $_GET['min'] . "'";
        }
        if (!empty($_GET['max'])) {
            $where .= " AND price <= '" . $_GET['max'] . "'";
        }
        $con = \Hackme\Heroku\ClearDB::getConnection();
        foreach ($con->query("SELECT * FROM product WHERE $where ORDER BY id") as $row) :
      ?>
      <tr>
        <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>
