<?php

namespace domain\files\storage;

use domain\files\FileData;
use domain\files\Files;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use ZipArchive;

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

    public function readAll(array $fileIds): void
    {
        $date = date('Y-m-d');
        $zipFullPath = tempnam(sys_get_temp_dir(), 'download_');
        $zipFileName = "solicitudes-$date.zip";

        $zip = new ZipArchive();
        if ($zip->open($zipFullPath, ZipArchive::CREATE) !== true) {
            echo "<script>alert('No se pudo crear el archivo ZIP.');</script>";
            exit;
        }

        $tempFiles = [];

        foreach ($fileIds as $fileId) {
            try {
                $blob = $this->storageClient->getBlob($this->containerName, $fileId);
                $content = stream_get_contents($blob->getContentStream());

                $tempFilePath = tempnam(sys_get_temp_dir(), 'file_');
                file_put_contents($tempFilePath, $content);
                $tempFiles[] = $tempFilePath;

                $zip->addFile($tempFilePath, basename($fileId));
            } catch (ServiceException $e) {
                error_log("Error al descargar $fileId desde Azure: " . $e->getMessage());
            }
        }

        $zip->close();

        if (!file_exists($zipFullPath)) {
            echo "<script>alert('Error al generar el archivo ZIP.');</script>";
            exit;
        }

        header('Content-Type: application/zip');
        header("Content-Disposition: attachment; filename=\"$zipFileName\"");
        header('Content-Length: ' . filesize($zipFullPath));

        readfile($zipFullPath);

        unlink($zipFullPath);
        foreach ($tempFiles as $tempFile) {
            unlink($tempFile);
        }

        exit;
    }

}