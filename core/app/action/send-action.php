<?php

use domain\files\FileData;
use domain\files\storage\StorageConnection;

if (isset($_POST["accept"])) {
    $fileData = uploadFile();
    $person = createPerson($fileData);
    $person->add();
    Core::alert("Informacion enviada exitosamente!");
}

Core::redir("./?view=job&id=$_POST[job_id]");


function uploadFile(): FileData
{
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileContent = file_get_contents($fileTmpPath);
    $storageConnection = new StorageConnection();
    $storage = $storageConnection->storage();
    $fileData = new FileData(uniqid(), $_FILES['file']['name'], $fileContent);
    $result = $storage->save($fileData);
    echo "<script>alert('El resultado de la subida fue:'" . $result . ");</script>";
    return $fileData;
}

function createPerson(FileData $fileData): PersonData
{
    $person = new PersonData();
    $person->name = $_POST["name"];
    $person->lastname = $_POST["lastname"];
    $person->phone = $_POST["phone"];
    $person->email = $_POST["email"];
    $person->file = $fileData->name;
    $person->job_id = $_POST["job_id"];
    return $person;
}
