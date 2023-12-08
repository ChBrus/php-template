<?php
    use PHPUnit\Framework\TestCase;
    use Core\DB;

    class DBTest extends TestCase {
        public function testEnv() {
            $database = new DB();
            $this->assertInstanceOf(\PDO::class, $database);
        }
    }
?>