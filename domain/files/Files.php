<?php

namespace domain\files;

interface Files
{
    public function save(FileData $file): bool;
    public function read(string $fileId): FileData;
}