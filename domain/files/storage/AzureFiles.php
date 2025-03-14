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
        $date = date('Y-m-d_H-i-s');
        $zipTempBase = tempnam(sys_get_temp_dir(), 'download_');
        unlink($zipTempBase);
        $zipFullPath = $zipTempBase . '.zip';
        $zipFileName = "solicitudes-$date.zip";

        $zip = new ZipArchive();
        if ($zip->open($zipFullPath, ZipArchive::CREATE) !== true) {
            error_log("No se pudo crear el archivo ZIP.");
            http_response_code(500);
            exit;
        }

        $tempFiles = [];
        $fileCount = 0;

        foreach ($fileIds as $fileId) {
            try {
                $blob = $this->storageClient->getBlob($this->containerName, $fileId);
                $content = stream_get_contents($blob->getContentStream());

                if ($content === false || strlen($content) === 0) {
                    error_log("Archivo $fileId vacío o ilegible desde Azure.");
                    continue;
                }

                $tempFilePath = tempnam(sys_get_temp_dir(), 'file_');
                file_put_contents($tempFilePath, $content);
                $tempFiles[] = $tempFilePath;

                $zip->addFile($tempFilePath, basename($fileId));
                $fileCount++;
            } catch (ServiceException $e) {
                error_log("Error al descargar $fileId desde Azure: " . $e->getMessage());
            }
        }

        $zip->close();

        if (!file_exists($zipFullPath) || $fileCount === 0) {
            error_log("ZIP no generado o sin archivos.");
            http_response_code(500);
            exit;
        }

        header('Content-Type: application/zip');
        header("Content-Disposition: attachment; filename=\"$zipFileName\"");
        header('Content-Length: ' . filesize($zipFullPath));
        flush();
        readfile($zipFullPath);

        unlink($zipFullPath);
        foreach ($tempFiles as $tempFile) {
            unlink($tempFile);
        }

        exit;
    }


}