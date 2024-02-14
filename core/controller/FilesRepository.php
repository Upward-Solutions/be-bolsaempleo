<?php

class FilesRepository
{
    private string $uploadDirectory;

    public function __construct($uploadDirectory) {
        $this->uploadDirectory = $uploadDirectory;
    }

    public function uploadFile(FileData $fileData): string
    {
        $fileName = $fileData->name;
        $fileTmpName = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($fileTmpName, $this->uploadDirectory . $fileName)) {
            return "Archivo subido correctamente.";
        } else {
            return "Error al subir el archivo.";
        }
    }
}