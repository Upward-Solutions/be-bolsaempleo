<?php

namespace domain\files;

class FileData
{
    public string $id;
    public string $name;
    public string $content;

    public function __construct(string $id, string $name, string $content)
    {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
    }

    public function __toString(): string
    {
        return 'FileData: name ' . $this->name . ', content ' . $this->content;
    }
}
