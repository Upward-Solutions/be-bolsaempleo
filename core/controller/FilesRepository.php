<?php

class FilesRepository
{
    private string $uploadDirectory;
    private string $environment;

    public function __construct($uploadDirectory)
    {
        $this->environment = getenv('ENVIRONMENT');
        $this->uploadDirectory = $uploadDirectory;
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
}