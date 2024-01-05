<?php

namespace Commands\Abstract;

abstract class AbstractCommand
{
    protected string $name;
    protected string $description;
    abstract public function getParameters(): ?array;
    abstract public function run(array $userParameters): mixed;
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
}
