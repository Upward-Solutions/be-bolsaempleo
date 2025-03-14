<?php

namespace domain\files\storage;

use Core;
use domain\files\FileData;
use domain\files\Files;
use ZipArchive;

class LocalFiles implements Files
{
    private string $containerName;
    private string $storageUrl;
    private string $uploadDirectory;

    public function __construct(string $storageUrl, string $containerName)
    {
        $this->storageUrl = $storageUrl;
        $this->containerName = $containerName;
        $this->uploadDirectory = $this->storageUrl . '/' . $this->containerName;
    }

    public function save(FileData $fileData): bool
    {
        $fileName = $fileData->name;
        $fileTmpName = $_FILES['file']['tmp_name'];
        return move_uploaded_file($fileTmpName, $this->uploadDirectory . $fileName);
    }

    public function read(string $fileId): void
    {
        $safeFileId = basename($fileId);
        $filePath = $this->uploadDirectory . $safeFileId;
        $originalContent = file_get_contents($filePath);
        if ($originalContent === false) {
            Core::alert("Error al leer el contenido del archivo.");
            exit;
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $contentType = match ($fileExtension) {
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            default => 'application/octet-stream',
        };

        if (file_exists($filePath)) {
            header('Content-Type: ' . $contentType);
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
        } else {
            echo "Archivo no encontrado";
        }
        exit;
    }

    public function readAll(array $fileIds): void
    {
        $zip = new ZipArchive();
        $zipFileName = tempnam(sys_get_temp_dir(), 'download_') . '.zip';

        if ($zip->open($zipFileName, ZipArchive::CREATE) !== true) {
            Core::alert("No se pudo crear el archivo ZIP.");
            exit;
        }

        foreach ($fileIds as $fileId) {
            $safeFileId = basename($fileId);
            $filePath = $this->uploadDirectory . $safeFileId;

            if (file_exists($filePath) && is_readable($filePath)) {
                $zip->addFile($filePath, $safeFileId);
            }
        }

        $zip->close();

        if (!file_exists($zipFileName)) {
            Core::alert("Error al generar el archivo ZIP.");
            exit;
        }

        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="archivos.zip"');
        header('Content-Length: ' . filesize($zipFileName));

        readfile($zipFileName);

        unlink($zipFileName);
        exit;
    }

}