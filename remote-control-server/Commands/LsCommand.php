<?php

namespace Commands;

use Commands\Abstract\AbstractCommand;
use Typing;

class LsCommand extends AbstractCommand
{
    public static string $name = "ls";
    public static string $description = "List all files and directory from the current directory.";
    public function __construct()
    {
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
        return $this->runErrorOnFalse("scandir", $directory);
    }
}
