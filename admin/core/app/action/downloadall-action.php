<?php

use domain\files\storage\StorageConnection;

// Inicializar el array de IDs de archivos
$fileIds = [];

// Verificar si se solicita descargar todos los CVs
if (isset($_GET['all']) && $_GET['all'] === 'true') {
    // Obtener todos los IDs de archivos de la base de datos
    $persons = PersonData::getAll();
    foreach ($persons as $person) {
        if (!empty($person->file)) {
            $fileIds[] = $person->file;
        }
    }
} else {
    // Obtener solo los IDs de archivos enviados por POST (página actual)
    $fileIds = $_POST['file_ids'] ?? [];
}

// Si no hay archivos para descargar, redirigir de vuelta
if (empty($fileIds)) {
    echo "<script>alert('No hay archivos para descargar'); window.location.href='index.php?view=persons';</script>";
    exit;
}

// Configurar límite de tiempo de ejecución para evitar timeouts en descargas grandes
set_time_limit(300); // 5 minutos
ini_set('memory_limit', '512M'); // Aumentar límite de memoria si es necesario

// Realizar la descarga
$storageConnection = new StorageConnection();
$storage = $storageConnection->storage();
$storage->readAll($fileIds);
