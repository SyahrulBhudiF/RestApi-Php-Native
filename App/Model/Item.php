<?php

namespace App\Model;

class Item
{
    public int $id;
    public string $name;
    public string $description;

    public function __construct($id = null, $name = null, $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}