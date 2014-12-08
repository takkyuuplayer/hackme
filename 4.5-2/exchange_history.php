<?php
  require_once('../vendor/autoload.php');
  ORM::configure('sqlite:../db/4.5.sqlite3');
  $db = ORM::get_db();
  $db->exec("
    CREATE TABLE IF NOT EXISTS exchange_history2 (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user TEXT NOT NULL,
        kouza TEXT NOT NULL,
        point INTEGER NOT NULL,
        created_at INTEGER
    );
    ");
  $histories = ORM::for_table('exchange_history2')
        ->order_by_desc('id')
        ->find_many()
    ;
?>
<h3>交換履歴(全員分出しちゃってます)</h3>
<table border="1">
<thead><tr>
    <th>User</th>
    <th>Kouza</th>
    <th>Point</th>
    <th>created_at</th>
</thead>
<tbody>
<?php foreach($histories as $history) : ?>
<tr>
<td><?php echo htmlspecialchars($history->user, ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($history->kouza, ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($history->point, ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars(date('Y-m-d H:i:s', $history->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
