<?php

namespace Commands;

use Commands\Abstract\AbstractCommand;
use Typing;

class LS extends AbstractCommand
{
    public function getParameters(): ?array
    {
        return [
            "directory" => [
                "type" => Typing::STRING,
                "required" => true,
            ],
        ];
    }
}
