<?php
use domain\files\storage\StorageConnection;
use domain\files\FileData;

if (isset($_POST["accept"])) {
    $fileData = uploadFile();
    $person = createPerson($fileData);
    $person->add();
    Core::alert("Informacion enviada exitosamente!");
}

Core::redir("./?view=job&id=$_POST[job_id]");


function uploadFile(): FileData
{
    $storageConnection = new StorageConnection();
    $storage = $storageConnection->storage();
    $fileData = new FileData($_FILES['file']['id'], $_FILES['file']['name']);
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
