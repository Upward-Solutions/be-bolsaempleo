<?php

namespace domain\environment;

class EnvironmentDetector
{
    public function isDev() : bool
    {
        $environment = EnvironmentDetector::get();
        return $environment == Environments::DEVELOPMENT;
    }

    private function get(): Environments {
        $environment = $_ENV['ENVIRONMENT'] ?? null;
        if ($environment !== null && Environments::isValid($environment)) {
            return Environments::from($environment);
        } else {
            return Environments::DEVELOPMENT;
        }
    }
}