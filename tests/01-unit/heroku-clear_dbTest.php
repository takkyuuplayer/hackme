<?php
class HerokuClearDBTest extends PHPUnit_Framework_TestCase
{
    public function testGetConfigWithClearDB()
    {
        putenv('CLEARDB_DATABASE_URL=mysql://username:password@hostname/dbname?reconnect=true');

        $this->assertEquals(
            \Hackme\Heroku\ClearDB::getConfig(),
            [
            'dsn'      => 'mysql:dbname=dbname;host=hostname;port=3306',
            'user'     => 'username',
            'password' => 'password',
            'db'       => 'dbname',
            ],
            'w/ clear db'
        );
    }
    public function testGetConfigWithoutClearDB()
    {
        $this->assertEquals(
            \Hackme\Heroku\ClearDB::getConfig(),
            [
            'dsn'      => 'mysql:dbname=hackme;host=localhost;port=3306',
            'user'     => 'hackmeuser',
            'password' => 'hackmeuser',
            'db'       => 'hackme',
            ]
        );
    }

    protected function tearDown()
    {
        putenv('CLEARDB_DATABASE_URL');
    }
}
