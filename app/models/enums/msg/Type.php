<?php
    namespace Enums\Msg;

    use Enums\Msg\Icons;

    enum Type {
        case Danger;
        case Success;

        public function getIcon() : string {
            return match($this) {
                Icons::Danger => Icons::Danger->print(),
                Icons::Success => Icons::Success->print(),
            };
        }
    }
?>