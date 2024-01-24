<?php

namespace Commands;

use Commands\Abstract\AbstractCommand;
use Typing;

class LsCommand extends AbstractCommand
{
    public function __construct()
    {
        $this->name = "ls";
        $this->description = "List all files and directory from the current directory.";
    }
    public function getParameters(): ?array
    {
        return [
            "directory" => [
                "type" => Typing::STRING,
                "required" => true,
            ],
        ];
    }
    protected function run(array $userParameters): array
    {
        $directory = $userParameters["directory"];
        $this->result = $this->runErrorOnFalse("scandir", $directory);
        return $this->result;
    }
}
