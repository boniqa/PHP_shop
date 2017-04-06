<?php
require_once __DIR__ . '/../vendor/autoload.php';
class MessageTest extends PHPUnit\Framework\TestCase
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
        return $this->createFlatXmlDataSet(__DIR__ . '/../datasets/Messages.xml');
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
    
    public function testIfANewMessageIsSaved() {
        $m = new Messages();
        $m->setUser_id('1');
        $m->setOrder_id('1');
        $m->setMessage('Test message 1');
        $this->assertFalse($m->saveMessage(self::$conn));
    }
    
    public function testIfMessageListIsReturned() {
        $m1 = new Messages();
        $m1->setUser_id('1');
        $m1->setMessage('Test message 1');
        $m1->setOrder_id('1');
        $m2 = new Messages();
        $m2->setUser_id('2');
        $m2->setMessage('Test message 2');
        $m2->setOrder_id('2');
        $test = new Messages();
        $this->assertArraySubset($test->returnAllMessages(self::$conn), ['1', 'Test message 1', '1']);
        $this->assertArraySubset($test->returnAllMessages(self::$conn), ['2', 'Test message 2', '2']);
    }
    
    //Masz może jakiś pomysl jak ugryźć zrobienie tego testu?
    public function testIfUsersMessagesAreLoaded() {
        
    }
}