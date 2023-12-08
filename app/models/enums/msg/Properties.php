<?php
    namespace Enums\Msg;

    enum Properties {
        case msg;
        case header;
        case icon;
        case location;
        case buildStyles;

        public function getValue() {
            return match($this) {
                self::msg => 'msg',
                self::header => 'header',
                self::icon => 'icon',
                self::location => 'location',
                self::buildStyles => 'buildStyles',
            };
        }
    }
?>