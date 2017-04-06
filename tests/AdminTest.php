<?php
require_once __DIR__ . '/../vendor/autoload.php';
class AdminTest extends PHPUnit\Framework\TestCase
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
        return $this->createFlatXmlDataSet(__DIR__ . '/../datasets/Admins.xml');
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
    
    public function testIfANewAdminIsSaved() {
        $a = new Admin();
        $a->setLogin('admin');
        $a->setPassword('password1');
        $this->assertTrue($a->saveNewAdmin(self::$conn));
    }
    
}