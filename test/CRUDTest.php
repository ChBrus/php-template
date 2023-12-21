<?php
    use PHPUnit\Framework\TestCase;
    use Core\User;

    class CRUDTest extends TestCase {
        public function testCRUD() {
            $user = new User('Something', 'Something');
            $user->addTable('users');

            $this->assertIsObject($user);
        }
    }
?>