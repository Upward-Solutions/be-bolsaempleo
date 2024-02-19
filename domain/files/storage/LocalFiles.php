<?php

namespace domain\files\storage;

use domain\files\FileData;
use domain\files\Files;

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
        $filePath = $this->uploadDirectory . $_GET['file_id'];
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
}