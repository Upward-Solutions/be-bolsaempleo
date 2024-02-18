<?php

namespace domain\files\storage;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

use domain\files\FileData;
use domain\files\Files;

class StagingStorage implements Files
{
    private string $containerName;
    private string $storageUrl;
    private BlobRestProxy $storageClient;

    public function __construct(string $storageUrl, string $containerName)
    {
        $this->storageUrl = $storageUrl;
        $this->containerName = $containerName;
        $this->createStorageClient();
    }

    private function createStorageClient(): void
    {
        $this->storageClient = BlobRestProxy::createBlobService($this->storageUrl);
    }

    public function save(FileData $fileData): bool
    {
        try {
            echo '<scritp>console.log('. "Llegó hasta acá" . ')</scritp>';
            $this->storageClient->createBlockBlob($this->containerName, $fileData->name, $fileData->content);
            return true;
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            Core::alert($code. ":" .$error_message.PHP_EOL);
            return false;
        }
    }

    public function read(string $fileId): FileData
    {
        // TODO: Implement read() method.
    }
}