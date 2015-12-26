<?php
namespace Hackme\Heroku;

class ClearDB
{
    private static $conn = null;

    private static $localConfig = [
      'dsn'      => 'mysql:dbname=hackme;host=localhost;port=3306',
      'username' => 'hackmeuser',
      'password' => 'hackmepass',
      'db'       => 'hackme',
    ];

    public static function getConfig()
    {
        if (! getenv("CLEARDB_DATABASE_URL")) {
            return self::$localConfig;
        }

        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $db = substr($url["path"], 1);

        return [
          'dsn'      => "mysql:dbname=$db;host=$server;port=3306",
          'username'     => $username,
          'password' => $password,
          'db'       => $db,
        ];

    }
    public static function getConnection()
    {
        if (is_null(self::$conn)) {
            $config = self::getConfig();
            self::$conn = new \PDO($config['dsn'], $config['username'], $config['password']);
        }
        return self::$conn;
    }
}
