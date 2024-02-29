<?php
    namespace Build\Message;

    enum Properties {
        case msg;
        case header;
        case icon;
        case location;
        case buildStyles;
        case buildScripts;

        public function getValue() {
            return match($this) {
                self::msg => 'msg',
                self::header => 'header',
                self::icon => 'icon',
                self::location => 'location',
                self::buildStyles => 'buildStyles',
                self::buildScripts => 'buildScripts',
            };
        }
    }