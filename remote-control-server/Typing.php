<?php

enum Typing: string
{
    case STRING = "string";
    case BOOLEAN = "boolean";
    case INTEGER = "integer";
    case DOUBLE = "double";
    case ARRAY = "array";
    case OBJECT = "object";
    case RESOURCE = "resource";
    case RESOURCE_CLOSED = "resource (closed)";
    case NULL = "NULL";
    case UNKNOWN_TYPE = "unknown type";
}
