<?php
require_once __DIR__ . '/../vendor/autoload.php';
class UserTest extends PHPUnit\Framework\TestCase
{
    private static $conn;
    
    public function getConnection() {
        $conn = new PDO(
            $GLOBALS['DB_DSN'],
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWD']
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }
    
    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/../datasets/Users.xml');
    }
    
    public static function setUpBeforeClass() {
        self::$conn = new mysqli('localhost', 
                $GLOBALS['DB_USER'], 
                $GLOBALS['DB_PASSWD'], 
                $GLOBALS['DB_NAME']);
    }
    
    public static function tearDownAfterClass() {
        self::$conn->close();
    } 
    
    //Zła asercja - Error: Failed asserting that false is true. Masz może jakiś pommysł jak to dobrze sprawdzić? :D
    public function testIfNewUsersAreSaved() {
        $u1 = new User();
        $u1->setName('test1');
        $u1->setSurname('user1');
        $u1->setMail('test@user1.pl');
        $u1->setPassword('password1');
        $u1->setAddress('Test 1/1 01-111 Testowo');
        $this->assertTrue($u1->saveUser(self::$conn));
        $u2 = new User();
        $u2->setName('test2');
        $u1->setSurname('user2');
        $u1->setMail('test@user2.pl');
        $u2->setPassword('pass0923');
        $u2->setAddress('Test 2/2 02-222 Testowo Małe');
        $this->assertTrue($u2->saveUser(self::$conn));
    }
    
    //Test przechodzi pomyslnie
    public function testIfUserIsDeleted() {
        $u1 = new User();
        $u1->setName('test1');
        $u1->setSurname('user1');
        $u1->setMail('test@user1.pl');
        $u1->setPassword('password1');
        $u1->setAddress('Test 1/1 01-111 Testowo');
        $this->assertTrue($u1->deleteUser(self::$conn, $u1->getId()));
    }
    
    //Test przechodzi pomyślnie
    public function testIfUserlistIsReturned() {
        $u1 = new User();
        $u1->setName('test1');
        $u1->setSurname('user1');
        $u1->setMail('test@user1.pl');
        $u1->setPassword('password1');
        $u1->setAddress('Test 1/1 01-111 Testowo');
        $u2 = new User();
        $u2->setName('test2');
        $u1->setSurname('user2');
        $u1->setMail('test@user2.pl');
        $u2->setPassword('pass0923');
        $u2->setAddress('Test 2/2 02-222 Testowo Małe');
        $test = new User();
        $this->assertArraySubset($test->returnAllUsers(self::$conn), ['test1', 'user1', 'test@user1.pl', 'password1', 'Test 1/1 01-111 Testowo']);
        $this->assertArraySubset($test->returnAllUsers(self::$conn), ['test2', 'user2', 'test@user2.pl', 'pass0923', 'Test 2/2 02-222 Testowo Małe']);
    }
    
}