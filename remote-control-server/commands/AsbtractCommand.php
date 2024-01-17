<?php

namespace Commands\Abstract;

use UnexpectedValueException;

abstract class AbstractCommand
{
    protected string $name;
    protected string $description;
    protected mixed $result;
    protected ?int $exitCode;
    abstract public function __construct();
    abstract public function getParameters(): ?array;
    abstract public function run(array $userParameters): mixed;
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
            throw new UnexpectedValueException();
            //TODO regler execption
        }
        $userParameter = $userParameters[$parameterName];
        if (
            !isset($parameterProperties["type"])
        ) {
            throw new UnexpectedValueException();
            //TODO regler execption
        }
        $expectedType = $parameterProperties["type"];
        if (
            !isset($expectedType->value)
        ) {
            throw new UnexpectedValueException();
            //TODO regler execption
        }
        $expectedTypeValue = $expectedType->value;
        if (gettype($userParameter) !== $expectedTypeValue) {
            throw new UnexpectedValueException();
            //TODO regler execption
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
