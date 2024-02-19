<?php

use domain\files\storage\StorageConnection;

$fileId = $_GET['file_id'];
$storageConnection = new StorageConnection();
$storage = $storageConnection->storage();
$storage->read($fileId);
