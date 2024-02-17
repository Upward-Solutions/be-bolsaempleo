<?php

namespace domain\files;

class FilesRepository
{
    private string $uploadDirectory;
    private string $environment;

    public function __construct($uploadDirectory)
    {
        $this->environment = getenv('ENVIRONMENT');
        $this->uploadDirectory = $uploadDirectory;
    }

    function read(string $filePath): void
    {
        $this->validateFile($filePath);
        $contentType = $this->getContentType($filePath);
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
    }


    public function uploadFile(FileData $fileData): string
    {
        if ($this->environment == "dev") {
            return $this->uploadToLocal($fileData);
        } else {
            return $this->uploadToAzure($fileData);
        }
    }

    private function uploadToLocal($fileData): string
    {
        $fileName = $fileData->name;
        $fileTmpName = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($fileTmpName, $this->uploadDirectory . $fileName)) {
            return "Archivo subido correctamente.";
        } else {
            return "Error al subir el archivo.";
        }
    }

    private function uploadToAzure($fileData): string
    {
        return "azure";
    }

    function validateFile(string $filePath): void
    {
        $originalContent = file_get_contents($filePath);
        if ($originalContent === false && file_exists($filePath)) {
            echo "<script>alert('Error al leer el contenido del archivo.');</script>";
            exit;
        }
    }

    function getContentType(string $filePath): string
    {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        return match ($fileExtension) {
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            default => 'application/octet-stream',
        };
    }
}