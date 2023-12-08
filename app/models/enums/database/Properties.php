<?php
    namespace Enums\DB;

    enum Properties {
        case alertHeader;

        public function getValue() {
            return match($this) {
                self::alertHeader => "alertHeader"
            };
        }
    }
?>