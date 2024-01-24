<?php

namespace Commands\Exceptions;

class MissingRequiredParameter extends \Exception
{
    protected string $missingParameterName;
    public function __construct(string $missingParameterName, int|null $code = 0, \Throwable|null $previous = null)
    {
        $this->missingParameterName = $missingParameterName;
        parent::__construct(
            message: $this->constructMessage(),
            code: $code,
            previous: $previous
        );
    }
    protected function constructMessage(): string
    {
        return "Missing required parameter \"{$this->missingParameterName}\".";
    }
}
