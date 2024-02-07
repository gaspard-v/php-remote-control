<?php

namespace Commands;

class Executor
{
    protected readonly array $commands;
    function __construct()
    {
        $commands = [
            LsCommand::$name => new LsCommand()
        ];
    }
}
