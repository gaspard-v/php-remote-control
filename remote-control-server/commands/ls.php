<?php

namespace Commands;

use Commands\Abstract\AbstractCommand;
use Typing;

class LsCommand extends AbstractCommand
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
    public function run(array $userParameters)
    {
        $directory = $userParameters["directory"];
        $result = scandir($directory);
    }
}
