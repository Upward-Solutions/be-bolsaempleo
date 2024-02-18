<?php
use domain\files\storage\StorageConnection;
use domain\files\FileData;

if (isset($_POST["accept"])) {
    $fileData = uploadFile();
    echo '<scritp>console.log('. "Archivo guardado satisfactoriamente" . ')</scritp>';
    $person = createPerson($fileData);
    $person->add();
    Core::alert("Informacion enviada exitosamente!");
}

Core::redir("./?view=job&id=$_POST[job_id]");


function uploadFile(): FileData
{
    $file = $_FILES['file'];
    $fileTmpPath = $file['tmp_name'];
    $fileContent = file_get_contents($fileTmpPath);
    echo '<scritp>console.log('. $file. ')</scritp>';
    echo '<scritp>console.log('. $fileContent . ')</scritp>';
    $storageConnection = new StorageConnection();
    $storage = $storageConnection->storage();
    $fileData = new FileData($file['id'], $file['name'], $fileContent);
    echo '<scritp>console.log('. $fileData . ')</scritp>';
    $storage->save($fileData);
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
