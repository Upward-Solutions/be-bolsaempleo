<?php

namespace domain\files\storage;

use domain\files\FileData;
use domain\files\Files;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

class AzureFiles implements Files
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
            $this->storageClient->createBlockBlob($this->containerName, $fileData->name, $fileData->content);
            return true;
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            $error = $code . ":" . $error_message . PHP_EOL;
            echo "<script>alert('" . $error . "');</script>";
            return false;
        }
    }

    public function read(string $fileId): void
    {
        try {
            echo '<script>window.open("https://bolsafilesdev.blob.core.windows.net/' . $this->containerName . '/' . $fileId . '", "_blank");</script>';
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            $error = $code . ":" . $error_message . PHP_EOL;
            echo "<script>alert('" . $error . "');</script>";
        }
    }
}