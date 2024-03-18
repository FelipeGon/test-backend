<?php

namespace App\Commands;

class AddTextCommand
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function execute()
    {
        return 'Adiciona "'.$this->text.'" ao sistema';
    }

    public function undo()
    {
        return 'Desfaz a adição do texto "'.$this->text.'"';
    }
}
