<?php
class HerokuClearDBTest extends PHPUnit_Framework_TestCase
{
    public function testGetConfigWithClearDB()
    {
        putenv('CLEARDB_DATABASE_URL=mysql://username:password@hostname/dbname?reconnect=true');

        $this->assertEquals(
            [
            'dsn'      => 'mysql:dbname=dbname;host=hostname;port=3306',
            'username'     => 'username',
            'password' => 'password',
            'db'       => 'dbname',
            ],
            \Hackme\Heroku\ClearDB::getConfig()
        );
    }
    public function testGetConfigWithoutClearDB()
    {
        $this->assertEquals(
            [
            'dsn'      => 'mysql:dbname=hackme;host=localhost;port=3306',
            'username' => 'hackmeuser',
            'password' => 'hackmepass',
            'db'       => 'hackme',
            ],
            \Hackme\Heroku\ClearDB::getConfig()
        );
    }

    public function testGetConnection()
    {
        $pdo = \Hackme\Heroku\ClearDB::getConnection();

        $this->assertInstanceOf('PDO', $pdo);
    }

    protected function tearDown()
    {
        putenv('CLEARDB_DATABASE_URL');
    }
}
