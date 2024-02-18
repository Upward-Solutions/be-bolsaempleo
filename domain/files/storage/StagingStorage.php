<?php

namespace domain\files\storage;

use domain\files\FileData;
use domain\files\Files;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

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
        echo "<script>alert('A punto de enviar el archivo');</script>";
        try {
            $result = $this->storageClient->createBlockBlob($this->containerName, $fileData->name, $fileData->content);
            echo "<script>alert('" . print_r($result, true) . "');</script>";
            return true;
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            $error = $code . ":" . $error_message . PHP_EOL;
            echo "<script>alert('" . $error . "');</script>";
            return false;
        }
    }

    public function read(string $fileId): FileData
    {
        // TODO: Implement read() method.
    }
}