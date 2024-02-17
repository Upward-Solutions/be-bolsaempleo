<?php

namespace domain\files\storage;

use domain\environment\EnvironmentDetector;
use domain\files\Files;
use domain\files\repository\LocalStorage;

class StorageConnection
{
    private string $storageUrl;
    private string $containerName;

    public function __construct()
    {
        $this->storageUrl = getenv('STORAGE_URL');
        $this->containerName = getenv('CONTAINER_NAME');
    }

    public function storage(): ?Files {
        $environmentDetector = new EnvironmentDetector();
        if ($environmentDetector->isDev()) {
            return new LocalStorage($this->storageUrl, $this->containerName);
        }
        return null;
    }
}