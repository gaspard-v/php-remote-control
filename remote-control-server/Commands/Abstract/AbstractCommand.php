<?php

namespace Commands\Abstract;

use Commands\Exceptions;
use ValueError;
use Commands\Traits;

abstract class AbstractCommand
{
    use Traits\Parameters;
    public static string $name;
    public static string $description;
    protected mixed $result;
    protected ?int $exitCode;
    abstract public function __construct();
    abstract public function getParameters(): ?array;
    abstract protected function run(array $userParameters): mixed;

    final public function execute(array $userParameters): mixed
    {
        $this->checkUserParameters($userParameters);
        $this->result = $this->run($userParameters);
        return $this->result;
    }
    final protected function runErrorOnFalse(callable $runFunction, ...$parameters): mixed
    {
        $result = $runFunction(...$parameters);
        if ($result === false) {
            $lastError = error_get_last();
            throw new \RuntimeException($lastError["message"]);
        }
        return $result;
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
