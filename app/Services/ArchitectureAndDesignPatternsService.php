<?php

namespace App\Services;

use App\Commands\AddTextCommand;

class ArchitectureAndDesignPatternsService
{
    /**
     *
     * @return mixed
     */
    public function run(): mixed
    {
        return true;
    }

    public function addText(string $text)
    {
        // Cria um novo comando e o executa
        $command = new AddTextCommand($text);
        $command->execute();
        return response()->json(['message' => 'Texto adicionado com sucesso']);
    }
}
