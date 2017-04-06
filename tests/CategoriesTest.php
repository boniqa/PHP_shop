<?php
require_once __DIR__ . '/../vendor/autoload.php';
class CategoriesTest extends PHPUnit\Framework\TestCase
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
        return $this->createFlatXmlDataSet(__DIR__ . '/../datasets/Categories.xml');
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
    
    public function testIfNewCategoriesAreSaved() {
        $c1 = new Categories();
        $c1->setName('Test category 1');
        $this->assertFalse($c1->saveUser(self::$conn));
        $c2 = new Categories();
        $c2->setName('Test category 2');
        $this->assertFalse($c2->saveUser(self::$conn));
    }
    
    //Test przechodzi pomyslnie
    public function testIfCategoryIsDeleted() {
        $c1 = new Categories();
        $c1->setName('Test category 1');
        $this->assertTrue($c1->deleteCategory(self::$conn, $c1->getId()));
    }
    
    //Test nie przechodzi pomyślnie - nie wiem jak to ugryźć
    public function testIfCategoryListIsReturned() {
        $u1 = new Categories();
        $u1->setName('Test category 1');
        $u2 = new Categories();
        $u2->setName('Test category 2');
        $test = new Categories();
        $this->assertArraySubset($test->returnAllCategories(self::$conn), ['Test category 1']);
        $this->assertArraySubset($test->returnAllCategories(self::$conn), ['Test category 2']);
    }
}