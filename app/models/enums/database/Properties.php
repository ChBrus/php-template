<?php
    namespace Enums\DB;

    enum Properties {
        case alertHeader;
        case alert;

        public function getValue() {
            return match($this) {
                self::alertHeader => "alertHeader",
                self::alert => "alert"
            };
        }
    }
?>