<?php

namespace Commands\Abstract;

use Commands\Exceptions;
use ValueError;

abstract class AbstractCommand
{
    protected string $name;
    protected string $description;
    protected mixed $result;
    protected ?int $exitCode;
    abstract public function __construct();
    abstract public function getParameters(): ?array;
    abstract protected function run(array $userParameters): mixed;

    final public function execute(array $userParameters): mixed
    {
        $this->checkUserParameters($userParameters);
        return $this->run($userParameters);
    }
    final static protected function checkUserParameter(
        string $parameterName,
        array $parameterProperties,
        array $userParameters
    ): mixed {
        if (
            isset($parameterProperties["required"]) &&
            $parameterProperties["required"] &&
            !isset($userParameters[$parameterName])
        ) {
            throw new Exceptions\MissingRequiredParameter($parameterName);
        }
        $userParameter = $userParameters[$parameterName];
        if (
            !isset($parameterProperties["type"])
        ) {
            throw new ValueError("Parameter {$parameterName} properties 
            does not have the required \"type\" property.");
        }
        $expectedType = $parameterProperties["type"];
        if (
            !isset($expectedType->value)
        ) {
            throw new ValueError("Parameter {$parameterName} type property 
            does not have the required \"value\" member. Check if the type property 
            type is from the enum Typing");
        }
        $expectedTypeValue = $expectedType->value;
        $userTypeValue = gettype($userParameter);
        if ($userTypeValue !== $expectedTypeValue) {
            throw new \InvalidArgumentException("parameter \"{$parameterName}\" type is {$userTypeValue}
            but the expected parameter type is {$expectedTypeValue}.");
        }
        return $userParameter;
    }

    final protected function checkUserParameters(array $userParameters): array
    {
        foreach ($this->getParameters() as $parameterName => $parameterProperties) {
            self::checkUserParameter($parameterName, $parameterProperties, $userParameters);
        }
        return $userParameters;
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
