<?php

namespace domain\environment;

class EnvironmentDetector
{
    public static function get(): Environments {
        $environment = $_ENV['ENVIRONMENT'] ?? null;
        if ($environment !== null && Environments::isValid($environment)) {
            return Environments::from($environment);
        } else {
            return Environments::DEVELOPMENT;
        }
    }
}