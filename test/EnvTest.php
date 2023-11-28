<?php
    use PHPUnit\Framework\TestCase;
    use Build\PageBuilder;
    use Tools\Env;

    class EnvTest extends TestCase {
        public function testEnv() {
            Env::getEnv();
            $this->assertEquals('/php-builder/', PageBuilder::getProjectURL());
        }
    }
?>