<?php

use domain\files\storage\StorageConnection;

$fileIds = $_POST['file_ids'] ?? [];
$storageConnection = new StorageConnection();
$storage = $storageConnection->storage();
$storage->readAll($fileIds);
