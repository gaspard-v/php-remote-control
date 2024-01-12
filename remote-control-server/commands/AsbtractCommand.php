<?php

namespace Commands\Abstract;

abstract class AbstractCommand
{
    protected string $name;
    protected string $description;
    protected mixed $result;
    protected ?int $exitCode;
    abstract public function getParameters(): ?array;
    abstract public function run(array $userParameters): mixed;
    final public function getName(): string
    {
        return $this->name;
    }
    final public function getDescription(): string
    {
        return $this->description;
    }
    final public function getResult(): mixed
    {
        return $this->result;
    }
    final public function getExitCode(): ?int
    {
        return $this->exitCode;
    }
}
