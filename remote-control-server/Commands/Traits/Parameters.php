<?php

namespace Commands\Traits;

use Commands\Exceptions;


trait Parameters
{
    final static protected function checkUserParameter(
        string $parameterName,
        array $parameterProperties,
        array $userParameters
    ) {
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
            throw new \ValueError("Parameter {$parameterName} properties 
            does not have the required \"type\" property.");
        }
        $expectedType = $parameterProperties["type"];
        if (
            !isset($expectedType->value)
        ) {
            throw new \ValueError("Parameter {$parameterName} type property 
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
}
