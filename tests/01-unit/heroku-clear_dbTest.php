<?php
class HerokuClearDBTest extends PHPUnit_Framework_TestCase
{
    public function testGetConfig()
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
}
