<?php

namespace environment;

enum Environments: string
{
    case DEVELOPMENT = "dev";
    case STAGING = "staging";
    case PRODUCTION = "prod";

    public static function isValid(string $value): bool {
        return in_array($value, [self::DEVELOPMENT, self::STAGING, self::PRODUCTION], true);
    }
}