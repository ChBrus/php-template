<?php
    use PHPUnit\Framework\TestCase;
    use Core\User;

    class CRUDTest extends TestCase {
        public function testCRUD() {
            $user = new User();
            $user->addTable('users');

            $this->assertIsNotNumeric($user->getRows());
        }
    }
?>