<?php

namespace domain\files;

interface Files
{
    public function save(FileData $fileData): bool;
    public function read(string $fileId): void;
    public function readAll(array $fileIds): void;
}