<?php

namespace domain\environment;

class EnvironmentDetector
{
    public function isDev() : bool
    {
        $environment = EnvironmentDetector::get();
        return $environment == Environments::DEVELOPMENT;
    }

    public function isStaging() : bool {
        $environment = EnvironmentDetector::get();
        return $environment == Environments::STAGING;
    }

    public function isProd() : bool {
        $environment = EnvironmentDetector::get();
        return $environment == Environments::PRODUCTION;
    }

    private function get(): Environments {
        $environment = $_ENV['ENVIRONMENT'] ?? null;
        if ($environment !== null) {
            return Environments::from($environment);
        } else {
            return Environments::DEVELOPMENT;
        }
    }
}