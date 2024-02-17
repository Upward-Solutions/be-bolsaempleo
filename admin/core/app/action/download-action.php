<?php
$filePath = '/var/www/html/uploads/' . $_GET['file_id'];
echo $filePath;

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
