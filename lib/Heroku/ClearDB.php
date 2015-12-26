<?php
namespace Hackme\Heroku;

class ClearDB
{
    private static $localConfig = [
      'dsn'      => 'mysql:dbname=hackme;host=localhost;port=3306',
      'user'     => 'hackmeuser',
      'password' => 'hackmeuser',
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
          'user'     => $username,
          'password' => $password,
          'db'       => $db,
        ];

    }
}
